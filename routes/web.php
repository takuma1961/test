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
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('shop.addToCart');//商品追加メソッド
Route::get('/cart', [ShopController::class, 'viewCart'])->name('shop.cart');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
Route::post('/checkout', [ShopController::class, 'placeOrder'])->name('shop.placeOrder');
Route::get('/administrator', [ShopController::class, 'administrator'])->name('shop.administrator');
Route::post('/administrator/create/store', [ShopController::class, 'store'])->name('shop.store');
Route::get('/administrator/create', [ShopController::class, 'create'])->name('shop.create');
Route::delete('/administrator/create/{id}',[ShopController::class,'delete'])->name('shop.delete');
Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove');//カートから商品を削除するメソッド
Route::get('/histtory',[ShopController::class, 'order_history'])->name('shop.order_history');//注文履歴表示
Route::delete('/histtory/delete/{id}', [ShopController::class, 'order_delete'])->name('shop.delete_history');//注文履歴削除メソッド

Route::get('/phpinfo', function () {
    phpinfo();
});