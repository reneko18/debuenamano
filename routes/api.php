<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductControllerTest;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\UserController;
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
Route::get('/table/draft/{user_id}', [ProductController::class, 'getProductsDraftByUserId']);
Route::get('/table/publish/{user_id}', [ProductController::class, 'getProductsPublishedByUserId']);
Route::get('/table/display/{user_id}', [ProductController::class, 'getProductsDisplayedByUserId']);
Route::get('/table/purchase/{user_id}', [ProductController::class, 'getProductsPurchasedByUserId']);
Route::get('/table/sold/{user_id}', [ProductController::class, 'getProductsSoldByUserId']);

//Test Admin by Case
Route::get('/table/admindraft', [ProductController::class, 'getProductsAdminDraftByUserId']);
Route::get('/table/adminpublish', [ProductController::class, 'getProductsAdminPublishedByUserId']);
Route::get('/table/adminselling', [ProductController::class, 'getProductsAdminSellingByUserId']);
Route::get('/table/admingcloseselling',[Productcontroller::class,'getProductAdminCloseSelling']);

Route::get('/table/adminpayments',[Productcontroller::class,'getProductAdminPayment']);
Route::get('/table/adminincoming',[Productcontroller::class,'getProductAdminIncoming']);

//Get products En Vitirina
Route::get('/vitrina',[ProductController::class, 'getProductsByPublishStatus']);

Route::post('/product/store', [ProductController::class, 'store'])->middleware('api');

//Edit product
Route::get('/products/edit/{product}',[Productcontroller::class,'editProduct']);

//Update Product Status
Route::put('/product/updatestatus/{product}',[ProductController::class,'updateProductStatus']);

//Update Product Payment Status
Route::put('/products/payment-status/{product}',[ProductController::class,'updateProductPaymentStatus']);

//Save Product Status
Route::put('/savestatus/{product}',[ProductController::class,'saveProductStatus']);

//Update product selling status
Route::put('/products/status/{product}', [ProductController::class, 'updateSellingStatus']);

//Update product contact (Mail, Whatsapp, Teléfono)
Route::put('/products/contact/{product}', [ProductController::class, 'updateMediaSelection']);

//Update product Admin Status (Comprado, En courier, Entregado, Devuelto, Finalizado)
Route::put('/products/admin-status/{product}', [ProductController::class, 'updateAdminStatus']);

//Delete product from the Admin
Route::delete('/products/delete/{product}',[ProductController::class,'destroyProduct']);

//Update Visible Status
Route::put('/products/visible-status/{product}',[ProductController::class,'updateVisibleStatusProduct']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Archive product
Route::get('/tienda/all',[ShopController::class, 'getArchiveProducts']);
Route::get('/tienda/categories/all',[ShopController::class, 'getArchiveCategories']);
Route::get('/tienda/agefilter/all',[ShopController::class, 'getAgeFilters']);
Route::get('/tienda/genders',[ShopController::class, 'getGenders']);

//API Regions and cities
Route::get('/regions', [RegionController::class,'index']);
Route::get('/cities/{region}', [CityController::class,'index']);

//API Categories
Route::get('/categories', [CategoryController::class,'index']);

//API Posts
Route::get('/posts', [PostController::class,'index']);
Route::get('/posts/all',[PostController::class,'adminindex']);

//API Categories
Route::get('/postscategories', [PostCategoryController::class,'index']);

//API Authors
Route::get('/authors', [AuthorController::class,'index']);

//API User Dashboard
Route::get('/user/{user}', [UserController::class,'index']);
Route::put('/user/{user}/updatepersinfo', [UserController::class,'updatepersinfo']);
Route::put('/user/{user}/updatepass', [UserController::class,'updatepass']);
Route::put('/user/{user}/bankdetails', [UserController::class,'bankdetails']);

Route::get('/user/{user}/getbankdetails',[UserController::class,'getbankdetails']);

//Count Products
Route::get('/cart/count',[CartController::class,'count'])->name('cart.count');

//Cart Controller Products 
// Route::apiResource('/cart', CartController::class);

//CART TOTAL
Route::post('/update-total', [CartController::class, 'updateTotal'])->name('update.total');

//API ORDER

Route::post('/orders', [OrderController::class, 'storeOrder'])->name('store.order');


//New Form
Route::post('/product/store/one', [ProductControllerTest::class, 'storePhaseOne'])->middleware('api');
Route::post('/product/store/two/{product}', [ProductControllerTest::class, 'storePhaseTwo'])->middleware('api');
Route::post('/product/store/three/{product}', [ProductControllerTest::class, 'storePhaseThree'])->middleware('api');
Route::post('/product/store/four/{product}', [ProductControllerTest::class, 'storePhaseFour'])->middleware('api');
Route::post('/product/store/draft-status/{product}', [ProductControllerTest::class, 'changeDraftStatus'])->middleware('api');

Route::post('/product/store/oneupdate/{product}',[ProductControllerTest::class,'updatePhaseOne'])->middleware('api');

Route::get('/product/getinfo/{product}',[ProductControllerTest::class,'getInfo'])->middleware('api');

Route::get('/product/getslug/{product}',[ProductControllerTest::class,'getSlug'])->middleware('api');

//Delete Image
Route::delete('/images/{id}', [ProductControllerTest::class, 'destroyImage'])->middleware('api');









