<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan semua produk yang ada di keranjang belanja
    public function index()
    {
        $cart_items_id = Cart::where('user_id', Auth::id())->pluck('product_id')->toArray();
        $cart_items = Product::whereIn("products.id", $cart_items_id)->join('sizes', 'size_id', 'sizes.id')
            ->select("products.*", "size_name")
            ->get();
        $products_images = ProductsImage::getProductImage($cart_items_id);
        return view('cart', ['cart_items' => $cart_items, 'products_images' => $products_images]);
    }

    // Menambahkan barang ke keranjang 
    public function store($product_id)
    {
        $user_id = Auth::id();
        $found_cart = Cart::where("user_id", $user_id)->where("product_id", $product_id);
        if ($found_cart->count() > 0) { // Jika barang sebelumnya sudah ada di keranjang, maka barang tsb akan dihapus
            $found_cart->delete();
            return back()->with('success', 'Produk dihapus dari keranjang');
        } else { // Jika belum, maka akan ditambahkan ke keranjang
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->save();
            return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        }
    }

    // Menghapus barang dari keranjang
    public function destroy($product_id)
    {
        $user_id = Auth::id();
        Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return back()->with('success',  'Produk dihapus dari keranjang');
    }
}
