<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
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

Route::get('/products',[ProductController::class, 'index']);

Route::get('/products/{id}',[ProductController::class, 'show']);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/products', [ProductController::class, 'index_admin']);
    Route::get('/products/add',[ProductController::class, 'create']);
    Route::post('/products/add', [ProductController::class, 'store']);

    Route::get('/products/{id}/edit',[ProductController::class, 'edit']);
    Route::post('/products/{id}/edit',[ProductController::class, 'update']);
    Route::post('/products/{id}/editpicture',[ProductController::class, 'editProductImages']);

    Route::get('/products/{id}/delete', [ProductController::class, 'destroy']);
});

Route::get('/wishlist',[WishlistController::class, 'index']);

Route::get('/wishlist/{id}/add',[WishlistController::class, 'store']);

Route::get('/wishlist/{id}/delete',[WishlistController::class, 'destroy']);

require __DIR__ . '/auth.php';