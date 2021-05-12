<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductsImage;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    // Menampilkan semua barang yang ada di wishlist
    public function index()
    {
        $wishlist_ids = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();

        $liked_products = Product::whereIn("id", $wishlist_ids)->get();

        $products_images = ProductsImage::getProductImage($wishlist_ids);

        return view('wishlist', ['liked_products' => $liked_products, 'products_images' => $products_images]);
    }

    // Menambahkan barang ke wishlist
    public function store($product_id)
    {
        $user_id = Auth::id();
        $found_wishlist = Wishlist::where("user_id", $user_id)->where("product_id", $product_id);
        
        if ($found_wishlist->count() > 0) { // Kondisi ketika barang sudah ada di wishlist, maka barang tsb akan dihapus
            $found_wishlist->delete();
            return back()->with('success', 'Produk dihapus dari wishlist');
        } 
        else {// Kondisi ketika barang belum ada di wishlist
            $wishlist = new Wishlist;
            $wishlist->user_id = $user_id;
            $wishlist->product_id = $product_id;
            $wishlist->save();
            return back()->with('success', 'Produk berhasil ditambahkan ke wishlist');
        }
    }

    // Menghapus barang dari wishlist
    public function destroy($product_id)
    {
        $user_id = Auth::id();
        Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return back()->with('success',  'Produk dihapus dari wishlist');
    }
}