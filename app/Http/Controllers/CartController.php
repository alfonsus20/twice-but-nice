<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_items = Cart::where('user_id', Auth::id())->pluck('product_id')->toArray();
        $added_products = Product::whereIn("products.id", $cart_items)->join('sizes', 'size_id', 'sizes.id')
        ->select("products.*", "size_name")
        ->get();
        $products_images = ProductsImage::whereIn('product_id', $cart_items)->get();
        return view('cart', ['added_products' => $added_products, 'products_images' => $products_images]);
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
    public function store($product_id)
    {
        $user_id = Auth::id();
        $found_cart = Cart::where("user_id", $user_id)->where("product_id", $product_id);
        if ($found_cart->count() > 0) {
            $found_cart->delete();
            return back()->with('success', 'Produk dihapus dari keranjang');
        } else {
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $product_id;
            $cart->save();
            return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($product_id)
    {
        $user_id = Auth::id();
        Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return back()->with('success',  'Produk dihapus dari keranjang');
    }
}
