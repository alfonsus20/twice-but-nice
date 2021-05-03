<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('index');
});

// Route::get('/cart', function () {
//     return view('cart');
// });

// Route::get('/checkout', function () {
//     return view('checkout');
// });

Route::get('/products', function () {
    return view('product-list');
});

Route::get('/products/{id}', function () {
    return view('product-detail');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/products', function () {
        return view('admin.products');
    });
    Route::get('/products/add', function () {
        return view('admin.add-product');
    });
    Route::post('/products/add', [ProductController::class, 'store']);
});

require __DIR__ . '/auth.php';