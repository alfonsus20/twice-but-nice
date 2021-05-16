<?php

namespace App\Http\Controllers;

use App\Mail\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShippingController extends Controller
{
    // Menampilkan daftar pengiriman barang
    public function index()
    {
        $shippings = DB::table('shippings')
        ->join('orders', 'order_id', 'orders.id')
        ->join('users', 'users.id', 'orders.user_id')
        ->select('shippings.*', 'orders.paid', 'users.name')
        ->paginate(10);
        return view('admin.shipping', ['shippings' => $shippings]);
    }

    // Mengubah delivery dari false menjadi true yang menandakan barang telah terkirim
    public function send($id){
        $shipping = Shipping::find($id);
        $shipping->delivered = true;
        $shipping->save();

        $order = Order::find($shipping->order_id);
        $user = User::find($order->user_id);
        $products = OrderItem::where('order_id', $order->id)
        ->join('products', 'product_id', 'products.id')
        ->get();

        $products_images = ProductsImage::getProductImage();

        Mail::to($user->email)->send(new Invoice($user->name, $products, $products_images, $shipping));
        
        return redirect('/admin/shipping')->with('success', 'Paket berhasil dikirim');
    }
}