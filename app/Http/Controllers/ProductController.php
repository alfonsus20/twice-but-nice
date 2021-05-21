<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\Review;
use App\Models\Size;
use App\Models\Wishlist;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;

class ProductController extends Controller
{
    // Tampilkan semua produk beserta informasi lengkapnya
    public function index(Request $request)
    {
        $products = DB::table('products')->where("available", "1")->join('categories', 'products.category_id', 'categories.id')
            ->join('sizes', 'products.size_id', 'sizes.id')
            ->select(
                'products.id',
                'products.name',
                'products.brand',
                'products.description',
                DB::raw("categories.id AS category_id"),
                'categories.category_name',
                'sizes.size_name',
                'products.quality',
                'products.price',
                'products.available',
                'products.created_at'
            );

        if ($request->has('keyword')) {
            $products->where('name', 'LIKE', '%' . $request->input('keyword') . '%');
        }

        // Sorting
        if ($request->has('sort')) {
            if ($request->sort == 'oldest') {
                $products->orderBy('created_at', 'asc');
            } else if ($request->sort == 'newest') {
                $products->orderBy('created_at', 'desc');
            } else if ($request->sort == 'lowestPrice') {
                $products->orderBy('price', 'asc');
            } else if ($request->sort == 'highestPrice') {
                $products->orderBy('price', 'desc');
            }
        }

        // Filtering
        if ($request->has('category')) {
            if ($request->category == "pria") {
                $products->where('sex', 1);
            } else if ($request->category == "wanita") {
                $products->where('sex', 0);
            } else {
                $products->where('category_id', $request->category);
            }
        }

        if ($request->has('brand')) {
            $products->where('brand', $request->brand);
        }

        if ($request->has('min_price') && $request->filled('min_price')) {
            $products->where('price', ">=", $request->min_price);
        }

        if ($request->has('max_price') && $request->filled('max_price')) {
            $products->where('price', "<=", $request->max_price);
        }

        if ($request->has('min_quality') && $request->filled('min_quality')) {
            $products->where('quality', ">=", $request->min_quality);
        }

        if ($request->has('max_quality') && $request->filled('max_quality')) {
            $products->where('quality', "<=", $request->max_quality);
        }

        $brands = Product::getBrands();
        $categories = Category::getCategories();
        $products = $products->paginate(9);

        $product_ids = array();
        foreach ($products as $product) {
            $product_ids[] = $product->id;
        }
        $products_images = ProductsImage::getProductImage();

        $user_wishlist_items_ids = Wishlist::getUserWishlistItemsIds();
        $user_cart_items_ids = Cart::getUserCartItemsIds();

        return view(
            'product-list',
            [
                'products' => $products,
                'products_images' => $products_images,
                'brands' => $brands,
                'categories' => $categories,
                'user_cart_items_ids' => $user_cart_items_ids,
                'user_wishlist_items_ids' => $user_wishlist_items_ids
            ]
        );
    }

    // Tampilkan produk untuk admin
    public function index_admin(Request $request)
    {

        $products = DB::table('products')->join('categories', 'products.category_id', 'categories.id')
            ->join('sizes', 'products.size_id', 'sizes.id')
            ->select('products.id', 'products.name', 'products.brand', 'products.description', "products.condition", 'categories.category_name',  'sizes.size_name', 'products.sex', 'products.quality', 'products.price', 'products.available');
        
        if ($request->has('keyword')) {
            $products->where('name', 'LIKE', '%' . $request->input('keyword') . '%');
        }

        $products = $products->paginate(10);
        
        return view('admin.products', ['products' => $products]);
    }

    // Tampilkan halaman form untuk menambahkan produk baru
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('admin.add-product', ['categories' => $categories, 'sizes' => $sizes]);
    }

    // Menambahkan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'sex' => 'required|boolean',
            'quality' => 'required|integer|min:1|max:10',
            'description' => 'required|string',
            'condition' => 'required|string',
            'category' => 'required',
            'size' => 'required',
            'weight' => 'required|integer',
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
        $product->condition = $request->condition;
        $product->category_id = $request->category;
        $product->size_id = $request->size;
        $product->sex = $request->sex;
        $product->quality = $request->quality;
        $product->weight = $request->weight;
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

    // Menampilkan halaman detail produk
    public function show($id)
    {
        $product = DB::table('products')->where("products.id", $id)->join('categories', 'products.category_id', 'categories.id')
            ->join('sizes', 'products.size_id', 'sizes.id')
            ->select('products.id', 'products.name', 'products.brand', 'products.description', "products.condition", 
                    'categories.category_name',DB::raw("categories.id AS category_id"),  'sizes.size_name', 'products.sex', 'products.quality', 'products.price', 
                    'products.available')
            ->first();
        $product_images = ProductsImage::where('product_id', $id)->get();

        $user_wishlist_items_ids = Wishlist::getUserWishlistItemsIds();
        $user_cart_items_ids = Cart::getUserCartItemsIds();

        $related_products = Product::where('category_id', $product->category_id)->get();
        $products_images = ProductsImage::getProductImage();

        return view(
            'product-detail',
            [
                'product' => $product, 'product_images' => $product_images,
                'related_products' => $related_products,
                'user_cart_items_ids' => $user_cart_items_ids,
                'user_wishlist_items_ids' => $user_wishlist_items_ids,
                'products_images' => $products_images
            ]
        );
    }

    // Mengubah foto produk
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
                $fileNameToStore = $fileName . "_" . time() . "_" . ((string)Str::uuid()) . "." . $ext;
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

    // Menampilkan halaman edit produk
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $sizes = Size::all();
        $images = ProductsImage::where('product_id', $id)->get();
        return view('admin.edit-product', ['product' => $product, 'categories' => $categories, 'sizes' => $sizes, 'images' => $images]);
    }

    // Mengupdate data produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'sex' => 'required|boolean',
            'quality' => 'required|integer|min:1|max:10',
            'description' => 'required|string',
            'condition' => 'required|string',
            'category' => 'required|string',
            'size' => 'required|string',
            'weight' => 'required|integer',
            'price' => 'required|integer',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->condition = $request->condition;
        $product->category_id = $request->category;
        $product->size_id = $request->size;
        $product->sex = $request->sex;
        $product->quality = $request->quality;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->save();
        return redirect('/admin/products')->with('success', 'Produk berhasil diupdate');
    }

    // Menghapus produk
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

    // Menampilkan produk di halaman produk
    public function index_home()
    {
        $newest_products = DB::table('products')->where('available', 1)->orderBy('created_at', 'desc')->take(5)->get();
        $featured_products = DB::table('products')->where('available', 1)->orderBy('quality', 'desc')->take(5)->get();
        $products_images = ProductsImage::getProductImage();
        $user_wishlist_items_ids = Wishlist::getUserWishlistItemsIds();
        $user_cart_items_ids = Cart::getUserCartItemsIds();
        $reviews = Review::getAllReviews();

        // dd($reviews);
        return view('index', [
            'newest_products' => $newest_products,
            'featured_products' => $featured_products,
            'user_cart_items_ids' => $user_cart_items_ids,
            'user_wishlist_items_ids' => $user_wishlist_items_ids,
            'products_images' => $products_images,
            'reviews' => $reviews
        ]);
    }
}
