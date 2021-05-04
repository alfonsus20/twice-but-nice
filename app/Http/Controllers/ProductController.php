<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\Size;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'], ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = DB::table('products')->join('categories', 'products.category_id', 'categories.id')
            ->join('colors', 'products.color_id', 'colors.id')->join('sizes', 'products.size_id', 'sizes.id')
            ->select('products.id', 'products.name', 'products.brand', 'products.description', 'categories.category_name', 'colors.color_name', 'sizes.size_name', 'products.price', 'products.available')
            ->paginate(9);

        $product_ids = array();

        foreach ($products as $product) {
            $product_ids[] = $product->id;
        }

        $products_images = ProductsImage::whereIn('product_id', $product_ids)->get();
        
        return view('product-list', ['products' => $products, 'products_images' => $products_images]);
    }

    public function index_admin()
    {

        $products = DB::table('products')->join('categories', 'products.category_id', 'categories.id')->join('colors', 'products.color_id', 'colors.id')
            ->join('sizes', 'products.size_id', 'sizes.id')
            ->select('products.id', 'products.name', 'products.brand', 'products.description', 'categories.category_name', 'colors.color_name', 'sizes.size_name', 'products.sex', 'products.quality','products.price', 'products.available')
            ->paginate(10);
        return view('admin.products', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.add-product', ['categories' => $categories, 'colors' => $colors, 'sizes' => $sizes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'sex' => 'required|boolean',
            'quality' => 'required|integer',
            'description' => 'required|string',
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
            $fileNameToStore = $fileName . "_" . time() . "_" . ((string)Str::uuid()) . "." . $ext;
            $image->move(public_path('img/products'), $fileNameToStore);
            $image_paths[] = $fileNameToStore;
        }

        $product = new Product;
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->color_id = $request->color;
        $product->size_id = $request->size;
        $product->sex = $request->sex;
        $product->quality = $request->quality;
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

    public function show($id)
    {
        $product = Product::find($id);
        $product_images = ProductsImage::where('product_id', $id)->get();
        return view('product-detail', ['product'=> $product, 'product_images'=>$product_images]);
    }

    public function editProductImages(Request $request, $id)
    {
        $images = $request->file('product_images');
        if (!$images) {
            return back();
        } else {
            $request->validate(['product_images' => 'required', 'product_images.*' => 'image|mimes:jpeg,png,jpg']);
            $image_paths = array();

            foreach ($images as $image) {
                $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = $image->getClientOriginalExtension();
                $fileNameToStore = $fileName . "_" . time() . "." . $ext;
                $image->move(public_path('img/products'), $fileNameToStore);
                $image_paths[] = $fileNameToStore;
            }

            $old_images = ProductsImage::where('product_id', $id);

            foreach ($old_images->get() as $old_image) {
                File::delete(asset('img/products') . '/' . $old_image->path);
            }

            $old_images->delete();

            foreach ($image_paths as $image_path) {
                $products_image = new ProductsImage;
                $products_image->product_id = $id;
                $products_image->path = $image_path;
                $products_image->save();
            }
            return back()->with('success', 'Foto produk berhasil diubah');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $images = ProductsImage::where('product_id', $id)->get();
        return view('admin.edit-product', ['product' => $product, 'categories' => $categories, 'colors' => $colors, 'sizes' => $sizes, 'images' => $images]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'sex' => 'required|boolean',
            'quality' => 'required|integer',
            'description' => 'required',
            'category' => 'required',
            'color' => 'required',
            'size' => 'required',
            'price' => 'required|integer',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->color_id = $request->color;
        $product->size_id = $request->size;
        $product->sex = $request->sex;
        $product->quality = $request->quality;
        $product->price = $request->price;
        $product->save();
        return back()->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $images = ProductsImage::where('product_id', $id);

        foreach ($images->get() as $image) {
            File::delete(asset('img/products') . '/' . $image->path);
        }

        $images->delete();
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
