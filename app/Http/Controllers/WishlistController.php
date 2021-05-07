<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        
        $liked_products = Product::whereIn("id" , $wishlist)->get();
        
        $products_images = ProductsImage::whereIn('product_id', $wishlist)->get();
        // print_r($liked_products[0]->name);
        return view('wishlist', ['liked_products' => $liked_products, 'products_images' => $products_images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id, $product_id)
    {
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
        $found_wishlist = Wishlist::where("user_id", $user_id)->where("product_id", $product_id);
        if ($found_wishlist->count() > 0) {
            $found_wishlist->delete();
            return back()->with('success', 'Produk dihapus dari wishlist');
        } else {
            $wishlist = new Wishlist;
            $wishlist->user_id = $user_id;
            $wishlist->product_id = $product_id;
            $wishlist->save();
            return back()->with('success', 'Produk berhasil ditambahkan ke wishlist');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
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
        Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return back()->with('success',  'Produk dihapus dari wishlist');
    }
}
