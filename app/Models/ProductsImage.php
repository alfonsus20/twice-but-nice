<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    use HasFactory;
    protected $table = 'products_images';

    public static function getProductImage($ids){
        $products_images = [];
        foreach ($ids as $id) {
            $products_images[$id] = ProductsImage::where('product_id', $id)->first()->path;
        }
        return $products_images;
    }
}
