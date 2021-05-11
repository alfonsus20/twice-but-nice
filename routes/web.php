<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CurlController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/products', [ProductController::class, 'index_admin']);
    Route::get('/products/add', [ProductController::class, 'create']);
    Route::post('/products/add', [ProductController::class, 'store']);

    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::post('/products/{id}/edit', [ProductController::class, 'update']);
    Route::post('/products/{id}/editpicture', [ProductController::class, 'editProductImages']);

    // Route::get('/products/{id}/delete', [ProductController::class, 'destroy']);
});

Route::group(['prefix' => 'wishlist', 'middleware' => ['auth']], function () {
    Route::get('/', [WishlistController::class, 'index']);

    Route::get('/{product_id}/add', [WishlistController::class, 'store']);

    Route::get('/{product_id}/delete', [WishlistController::class, 'destroy']);
});

Route::group(['prefix' => 'cart', 'middleware' => ['auth']], function () {
    Route::get('/', [CartController::class, 'index']);

    Route::get('/{product_id}/add', [CartController::class, 'store']);

    Route::get('/{product_id}/delete', [CartController::class, 'destroy']);
});

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function () {
    Route::get('/', [ProfileController::class, 'index']);

    Route::post('/update', [ProfileController::class, 'update']);
});

Route::group(['prefix' => 'order', 'middleware' => ['auth']], function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{id}/delete', [OrderController::class, 'destroy']);
    Route::post('/create', [OrderController::class, 'store']);
});


Route::get('checkout', [OrderController::class, 'showCheckoutPage']);

Route::get('contact', function () {
    return view('contact');
});


Route::get("curl", [CurlController::class, 'getCity']);

require __DIR__ . '/auth.php';

Route::get('/categories', 'CategoryController@index');
Route::get('/categories/{id}', 'CategoryController@show');
Route::get('/categories/{id}/edit', 'CategoryController@edit');
Route::post('/categories/{id}/update', 'CategoryController@update');

Route::get('/size', 'SizeController@index');
Route::get('/size/{id}', 'SizeController@show');
Route::get('/size/{id}/edit', 'SizeController@edit');
Route::post('/size/{id}/update', 'SizeController@update');