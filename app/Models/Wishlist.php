<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';

    public static function getUserWishlistItemsIds()
    {
        $user_id = Auth::id();
        return  Wishlist::where('user_id', $user_id)->pluck('product_id')->toArray();    
    }
}
