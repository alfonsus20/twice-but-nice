<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public static function getBrands(){
        $brands = DB::table('products')->groupBy('brand')->select('brand')->get();
        return $brands;
    }
}