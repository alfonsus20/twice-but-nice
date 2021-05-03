<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductsImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->only(['store', 'destroy']);
    }

    public function index()
    {
        //
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
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'color' => 'required',
            'size' => 'required',
            'product_images' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg',
            'price' => 'required|integer',
        ]);

        $images = $request->file('product_images');
        $image_paths = array();

        foreach ($images as $image) {
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $image->getClientOriginalExtension();
            $fileNameToStore = $fileName . "_" . time() . "." .$ext;
            $image->move(public_path('img/products'), $fileNameToStore);
            $image_paths[] = $fileNameToStore;
        }

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->color_id = $request->color;
        $product->size_id = $request->size;
        $product->price = $request->price;
        $product->save();


        foreach ($image_paths as $image_path) {
            $products_image = new ProductsImage;
            $products_image->product_id = $product->id;
            $products_image->path = $image_path;
            $products_image->save();
        }

        return redirect('/admin/products/add')->with('success', 'Produk berhasil ditambahkan');
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
    public function destroy($id)
    {
        //
    }
}
