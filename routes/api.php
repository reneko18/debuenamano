<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Test products by ID
Route::get('/table/publish/{user_id}', [ProductController::class, 'getProductsPublishedByUserId']);
Route::get('/table/display/{user_id}', [ProductController::class, 'getProductsDisplayedByUserId']);
Route::get('/table/purchase/{user_id}', [ProductController::class, 'getProductsPurchasedByUserId']);

//Test Admin by Case
Route::get('/table/adminpublish', [ProductController::class, 'getProductsAdminPublishedByUserId']);

//Get products En Vitirina
Route::get('/vitrina',[ProductController::class, 'getProductsByPublishStatus']);

Route::post('/product/store', [ProductController::class, 'store'])->middleware('api');



//Update product selling status
Route::put('/products/status/{product}', [ProductController::class, 'updateSellingStatus']);

//Update product contact (Mail, Whatsapp, Teléfono)
Route::put('/products/contact/{product}', [ProductController::class, 'updateMediaSelection']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API Regions and cities
Route::get('/regions', [RegionController::class,'index']);
Route::get('/cities/{region}', [CityController::class,'index']);

//API Categories
Route::get('/categories', [CategoryController::class,'index']);

//API Posts
Route::get('/posts', [PostController::class,'index']);

//API Categories
Route::get('/postscategories', [PostCategoryController::class,'index']);

//API Authors
Route::get('/authors', [AuthorController::class,'index']);

//Count Products
Route::get('/cart/count',[CartController::class,'count'])->name('cart.count');

//Cart Controller Products 
Route::apiResource('/cart', CartController::class);

//Comentario en rutas para Carlos
// Recibido René 10-4






