<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';

    // Mendapatkan barang yang ada di keranjang user yang sedang login
    public static function getUserCartItems()
    {
        $cart_items_ids = Cart::getUserCartItemsIds();
        $cart_items = Product::whereIn("products.id", $cart_items_ids)->join('sizes', 'size_id', 'sizes.id')
            ->select("products.*", "size_name")
            ->get();
        return $cart_items;
    }

    public static function getUserCartItemsIds()
    {
        $cart_items_ids = Cart::where('user_id', Auth::id())->pluck('product_id')->toArray();
        return $cart_items_ids;
    }
}
