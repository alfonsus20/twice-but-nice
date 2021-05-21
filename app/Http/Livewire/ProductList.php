<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\Wishlist;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public $sort;
    public $category;
    public $brand;
    public $max_price;
    public $min_price;
    public $max_quality;
    public $min_quality;

    protected $queryString = ['keyword', 'sort', 'category', 'brand', 'max_price', 'min_price', 'max_quality', 'min_quality'];
    private $products;


    public function __construct()
    {
        $this->products =  Product::where("available", "1")->join('categories', 'products.category_id', 'categories.id')
            ->join('sizes', 'products.size_id', 'sizes.id')
            ->select(
                'products.id',
                'products.name',
                'products.brand',
                'products.description',
                "categories.id AS category_id",
                'categories.category_name',
                'sizes.size_name',
                'products.quality',
                'products.price',
                'products.available',
                'products.created_at'
            );
    }

    public function filter()
    {
        $this->products->where('name', 'LIKE', '%' . $this->keyword . '%');
    }


    public function updatingKeyword()
    {
        $this->resetPage();
    }
  
    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingBrand()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice(){
        $this->resetPage();
    }

    public function updatingMinPrice(){
        $this->resetPage();
    }

    public function updatingMaxQuality(){
        $this->resetPage();
    }

    public function updatingMinQuality(){
        $this->resetPage();
    }

    public function sort($param)
    {
        if ($param == 'oldest') {
            $this->products->orderBy('created_at', 'asc');
        } else if ($param == 'newest') {
            $this->products->orderBy('created_at', 'desc');
        } else if ($param == 'lowestPrice') {
            $this->products->orderBy('price', 'asc');
        } else if ($param == 'highestPrice') {
            $this->products->orderBy('price', 'desc');
        }
    }

    public function render()
    {
        // Searching by keyword
        if ($this->keyword) {
            $this->products->where('name', 'LIKE', '%' . $this->keyword . '%');
        }

        // Sorting
        if ($this->sort) {
            if ($this->sort == 'oldest') {
                $this->products->orderBy('created_at', 'asc');
            } else if ($this->sort == 'newest') {
                $this->products->orderBy('created_at', 'desc');
            } else if ($this->sort == 'lowestPrice') {
                $this->products->orderBy('price', 'asc');
            } else if ($this->sort == 'highestPrice') {
                $this->products->orderBy('price', 'desc');
            }
        }

        // Filtering
        if ($this->category) {
            if ($this->category == "pria") {
                $this->products->where('sex', 1);
            } else if ($this->category == "wanita") {
                $this->products->where('sex', 0);
            } else {
                $this->products->where('category_id', $this->category);
            }
        }

        if ($this->brand) {
            $this->products->where('brand', $this->brand);
        }

        if ($this->min_price) {
            $this->products->where('price', ">=", $this->min_price);
        }

        if ($this->max_price) {
            $this->products->where('price', "<=", $this->max_price);
        }

        if ($this->min_quality) {
            $this->products->where('quality', ">=", $this->min_quality);
        }

        if ($this->max_quality) {
            $this->products->where('quality', "<=", $this->max_quality);
        }

        $brands = Product::getBrands();
        $categories = Category::getCategories();
        $this->products = $this->products->paginate(9);

        $product_ids = array();
        foreach ($this->products as $product) {
            $product_ids[] = $product->id;
        }
        $products_images = ProductsImage::getProductImage();

        $user_wishlist_items_ids = Wishlist::getUserWishlistItemsIds();
        $user_cart_items_ids = Cart::getUserCartItemsIds();

        return view(
            'livewire.product-list',
            [
                'products' => $this->products,
                'products_images' => $products_images,
                'brands' => $brands,
                'categories' => $categories,
                'user_cart_items_ids' => $user_cart_items_ids,
                'user_wishlist_items_ids' => $user_wishlist_items_ids
            ]
        );
    }
}