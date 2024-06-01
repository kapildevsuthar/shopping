<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Category;
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

use App\Http\Controllers\ProductMediaController;

Route::get('/products/{product}/media/create', [ProductMediaController::class, 'create'])->name('product_media.create');
Route::post('/products/{product}/media', [ProductMediaController::class, 'store'])->name('product_media.store');
// web.php

Route::resource('/cart',CartController::class);