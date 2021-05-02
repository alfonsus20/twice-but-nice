<?php

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

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'role:admin']);

Route::get('/products', function () {
    return view('product-list');
});

Route::get('/products/{id}', function () {
    return view('product-detail');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
