<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Support\Facades\DB;

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
        return redirect('/admin/shipping')->with('success', 'Paket berhasil dikirim');
    }
}