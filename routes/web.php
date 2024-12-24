<?php

use App\Http\Controllers\ShopController;
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
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('shop.addToCart');
Route::get('/cart', [ShopController::class, 'viewCart'])->name('shop.cart');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
Route::post('/checkout', [ShopController::class, 'placeOrder'])->name('shop.placeOrder');
//getに修正
Route::get('/products/create', [ShopController::class, 'create'])->name('shop.create');
Route::post('/products', [ShopController::class, 'store'])->name('shop.store');
