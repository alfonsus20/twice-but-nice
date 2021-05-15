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
    // Menampilkan halaman checkout
    public function showCheckoutPage()
    {
        $cart = new Cart();
        $shipping = new Shipping();
        $cart_items = $cart->getUserCartItems();

        $weight = 50;

        foreach ($cart_items as $item) {
            if (!$item->available) {
                return back()->with('error', 'Terdapat produk yang stoknya habis');
            }
            $weight = $weight + $item->weight;
        }

        $user = Auth::user();
        $shipping_cost = $shipping->getDeliveryCosts(256, $user->city_id, $weight);

        $products_images = ProductsImage::getProductImage();

        // Dapatkan info mengenai kota dan provinsi user
        $destination_details = $shipping->getCity($user->province_id, $user->city_id);
        $province = $destination_details->province;
        $city_name = $destination_details->city_name;

        return view('checkout', [
            'cart_items' => $cart_items,
            'shipping_cost' => $shipping_cost,
            'products_images' => $products_images,
            'province' => $province,
            'city_name' => $city_name,
        ]);
    }

    // Menampilkan pesanan user
    public function index()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)
            ->join("shippings", "shippings.order_id", "orders.id")
            ->select('orders.*', 'shippings.delivered', 'shippings.courier', 'shippings.service')
            ->get();

        $order_items = OrderItem::whereIn('order_items.order_id', $orders->pluck('id'))
            ->join("products", "products.id", "order_items.product_id")
            ->select("products.*", "order_items.order_id")
            ->get();

        $products_images = ProductsImage::getProductImage();
        return view("order", ["orders" => $orders, "products_images" => $products_images, "order_items" => $order_items]);
    }

    // Membuat pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            "delivery" => "required"
        ]);

        $cart = new Cart();
        $shipping = new Shipping();
        $cart_items = $cart->getUserCartItems();
        $user = Auth::user();
        $weight = 0;

        foreach ($cart_items as $item) {
            if (!$item->available) {
                return back()->with('error', 'Terdapat produk yang stoknya habis');
            }
            $weight = $weight + $item->weight;
        }

        // Dapatkan info mengenai pengiriman dari API RajaOngkir
        $shipping_costs = $shipping->getDeliveryCosts(256, $user->city_id, $weight);
        $shipping_info = explode("|", $request->delivery);
        $shipping_cost = 0;

        if ($shipping_costs[$shipping_info[0]][0]->code == $shipping_info[0]) {
            foreach ($shipping_costs[$shipping_info[0]][0]->costs as $cost) {
                if ($cost->service == $shipping_info[1]) {
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
        $shipping->courier = $shipping_info[0];
        $shipping->service = $shipping_info[1];
        $shipping->cost = $shipping_cost;
        $shipping->save();

        return redirect("/order")->with("success", "Pesanan berhasil dibuat");
    }

    // Menampilkan detail order
    public function show($id)
    {
        $order = Order::where('orders.id', $id)->join('shippings', 'orders.id', 'shippings.order_id')
            ->select('orders.*', 'shippings.cost',  'shippings.courier', 'shippings.service')
            ->first();
        $order_items = OrderItem::where('order_id', $id)
            ->get();
        $products = Product::whereIn('products.id', $order_items->pluck('product_id')->toArray())
            ->join('sizes', 'products.size_id', "sizes.id")
            ->select('products.*', 'sizes.size_name')
            ->get();
        $products_images = ProductsImage::getProductImage();
        $payment = Payment::where('order_id', $order->id)->first();

        // Integrasi dengan Midtrans Payment Gateway
        $user = Auth::user();

        $snapToken = "";

        $current_status = 'unpaid';

        if (!$order->paid && !$payment) { // Jika order merupakan order yang baru, maka minta snap token ke API Midtrans
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
        } else if (!$order->paid && $payment) { //Jika order yang ditampilkan adalah order lama, namun pembayarannya belum selesai
            $payment_obj = new Payment();
            $payment_data = $payment_obj->getPaymentData($order->id); // Dapatkan info terbaru tentang pembayaran
            $current_status = $payment_data->transaction_status;
            $payment = Payment::find($payment_data->transaction_id);
            $payment->status = $current_status;
            $payment->save();

            if ($current_status == Payment::SETTLEMENT || $current_status == Payment::CAPTURE) { // Jika pembayaran berhasil dilakukan
                $order->paid = true; // Status pembayaran order diubah menjadi true yang artinya sudah dibayar
                $order->save();
            }
        }

        return view('order-detail', [
            'products' => $products,
            'products_images' => $products_images,
            'order' => $order,
            'snapToken' => $snapToken,
            'current_status' => $current_status,
        ]);
    }

    // Membatalkan/menghapus order
    public function destroy($id)
    {
        $order = Order::find($id);
        $order_items = OrderItem::where('order_id', $id);

        $products = Product::whereIn("id", $order_items->pluck('product_id')->toArray())->get();
        foreach ($products as $product) {
            var_dump($product);
            $product->available = true; // Jika order dibatalkan, stok setiap produk dalam order dikembalikan menjadi tersedia
            $product->save();
        }

        $order_items->delete(); // Data produk order dihapus 

        $shipping = Shipping::where('order_id', $id);
        $shipping->delete(); // Pengiriman order dibatalkan

        $payment = Payment::where('order_id', $id);
        $payment->delete();

        $order->delete(); // Order dihapus

        return redirect('/order')->with('success', 'Pesanan berhasil dibatalkan');
    }
}
