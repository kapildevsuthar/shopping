<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductMediaController;
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
    return view('welcome');
});

Route::get('/kapil',function (){
    return view('my');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/category',CategoryController::class);
Route::resource('/products',ProductController::class);
// Route::delete('/category/delete',[CategoryController::class,'deleted']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', [App\Http\Controllers\ProductController::class, 'list'])->name('products.list');



Route::get('/products/{product}/media/create', [ProductMediaController::class, 'create'])->name('product_media.create');
Route::post('/products/{product}/media', [ProductMediaController::class, 'store'])->name('product_media.store');
// web.php
Route::get('/mediadel/{id}', [ProductController::class, 'mediadelete']);

Route::middleware('auth')->group(function () {
    // Route::resource('/cart',CartController::class);

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/remove', [CartController::class, 'remove'])->name('cart.remove');
// web.php
Route::patch('/cart/update', 'CartController@update')->name('cart.update');
Route::delete('/cart/remove', 'CartController@remove')->name('cart.remove');


});