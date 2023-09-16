<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\frontend\SellingFormController;
use App\Http\Controllers\frontend\ShopController;
use App\Http\Controllers\frontend\SingleProductController;
use App\Http\Controllers\admin\TestController;
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

Route::prefix('admin')->group( function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');
    Route::resource('productos', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('tests', TestController::class);
});



Route::get('/tienda',[ShopController::class, 'index'])->name('shop.index');

Route::get('/productos/{product}',[SingleProductController::class, 'show'])->name('product.show');

Route::get('/formulario-venta',[SellingFormController::class,'showform'])->name('sellingformold.show');

Route::get('/new-formulario-venta',[SellingFormController::class,'show'])->name('sellingform.show');

Route::get('/single-product',[SingleProductController::class,'singleShow'])->name('single.show');
