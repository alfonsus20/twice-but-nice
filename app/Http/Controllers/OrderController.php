<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckoutPage()
    {
        $cart = new CartController();
        $curl = new CurlController();
        $cart_items = $cart->getUserCartItems();

        $weight = 50;

        foreach ($cart_items as $item) {
            if (!$item->available) {
                return back()->with('error', 'Terdapat produk yang stoknya habis');
            }
            $weight = $weight + $item->weight;
        }

        $user = Auth::user();
        $delivery_costs = $curl->getDeliveryCosts(256, $user->city_id, $weight);

        $products_images = ProductsImage::whereIn('product_id', $cart_items->pluck('id')->toArray())->get();
        return view('checkout', ['cart_items' => $cart_items, 'delivery_costs' => $delivery_costs, 'products_images' => $products_images]);
    }


    public function index()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();

        $order_items = OrderItem::whereIn('order_id', $orders->pluck('id'))
            ->join("products", "products.id", "order_items.product_id")
            ->select("products.*", "order_items.order_id")
            ->get();

        $products_images = ProductsImage::whereIn('product_id', $order_items->pluck('id')->toArray())->get();

        // var_dump($products_images);
        // $products_images = ProductsImage::whereIn('product_id', $orders->pluck('product_id')->toArray())->get();
        return view("order", ["orders" => $orders, "products_images" => $products_images, "order_items" => $order_items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "delivery" => "required"
        ]);

        $cart = new CartController();
        $curl = new CurlController();
        $cart_items = $cart->getUserCartItems();

        $weight = 0;

        foreach ($cart_items as $item) {
            if (!$item->available) {
                return back()->with('error', 'Terdapat produk yang stoknya habis');
            }
            $weight = $weight + $item->weight;
        }



        $user = Auth::user();
        $delivery_cost = $curl->getDeliveryCosts(256, $user->city_id, $weight);

        $delivery_info = explode("|", $request->delivery);

        $shipping_cost = 0;

        if ($delivery_cost[$delivery_info[0]][0]->code == $delivery_info[0]) {
            foreach ($delivery_cost[$delivery_info[0]][0]->costs as $cost) {
                if ($cost->service == $delivery_info[1]) {
                    $shipping_cost = $cost->cost[0]->value;
                    break;
                }
            }
        }

        $order = new Order;
        $order->user_id = $user->id;
        $order->save();

        $total = 0;
        foreach ($cart_items as $item) {
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->product_id = $item->id;
            $order_item->save();
            $product = Product::find($item->id);
            $total = $total + $item->price;
            $product->available = false;
            $product->save();
            $user_cart = Cart::where('product_id', $item->id);
            $user_cart->delete();
        }

        $found_order = Order::find($order->id);
        $found_order->total = $total + $shipping_cost;
        $found_order->save();

        $shipping =  new Shipping;
        $shipping->order_id = $order->id;
        $shipping->delivered = false;
        $shipping->courier = $delivery_info[0];
        $shipping->service = $delivery_info[1];
        $shipping->cost = $shipping_cost;
        $shipping->save();

        return redirect("/order")->with("success", "Pesanan berhasil dibuat");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('orders.id', $id)->join('shippings', 'orders.id', 'shippings.order_id')
            ->select('orders.*', 'shippings.cost')
            ->first();
        $order_items = OrderItem::where('order_id', $id)
            ->get();
        $products = Product::whereIn('products.id', $order_items->pluck('product_id')->toArray())
            ->join('sizes', 'products.size_id', "sizes.id")
            ->select('products.*', 'sizes.size_name')
            ->get();
        $products_images = ProductsImage::whereIn('product_id', $order_items->pluck('product_id')->toArray())->get();

        $payment = Payment::where('order_id', $order->id)->first();
        // Midtrans Payment Gateway
        $user = Auth::user();
        
        $snapToken = "";

        $current_status = 'unpaid';

        if (!$order->paid && !$payment) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->id,
                    'gross_amount' => $order->total,
                ),
                'customer_details' => array(
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->telephone,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } else if (!$order->paid && $payment) {
            $payment_controller = new PaymentController();
            $payment_data = $payment_controller->getPaymentData($order->id);
            $current_status = $payment_data->transaction_status;
            $payment = Payment::find($payment_data->transaction_id);
            $payment->status = $current_status;
            $payment->save();

            if ($current_status == Payment::SETTLEMENT || $current_status == Payment::CAPTURE) {
                $order->paid = true;
                $order->save();
            }
        }

        return view('order-detail', ['products' => $products, 'products_images' => $products_images, 'order' => $order, 'snapToken' => $snapToken, 'current_status' => $current_status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        // $payment = Payment::where('order_id', $id)->get();
        // $payment->delete();
        $order_items = OrderItem::where('order_id', $id);
        $products = Product::whereIn("id", $order_items->pluck('product_id')->toArray())->get();
        foreach ($products as $product) {
            var_dump($product);
            $product->available = true;
            $product->save();
            print('hei');
        }
        $order_items->delete();
        $shipping = Shipping::where('order_id', $id);
        $shipping->delete();
        $order->delete();
        return back()->with('success', 'Pesanan berhasil dihapus');
    }
}
