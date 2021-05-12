<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $sold = Product::where('available', 0);
        $not_sold = Product::where('available', 1);
        $income = Product::where('available', 0)->sum('price');


        return view('admin.index', ['income' => $income, 'sold' => $sold, 'not_sold' => $not_sold]);
    }
}
