<?php

use App\Http\Controllers\admin\AuthorController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ImageUploadController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\PostCategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\frontend\SellingFormController;
use App\Http\Controllers\frontend\ShopController;
use App\Http\Controllers\frontend\SingleProductController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\ChilexpressController;
use App\Http\Controllers\frontend\WebpayPlusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;

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

//Test Dashboard
Route::get('/dashboard/user/{user}',[UserController::class,'adminUser'])->name('dashboard.client');

Route::get('/new-formulario-venta',[SellingFormController::class,'show'])->name('sellingform.show')->middleware('auth');
Route::get('/formulario-test',[SellingFormController::class,'displayForm'])->name('formtest.show')->middleware('auth');
Route::get('/formulario-test/{product}',[SellingFormController::class,'displayUnfinishedForm'])->name('formtestunfi.show')->middleware('auth');

Route::get('/exito-producto-venta',[SellingFormController::class,'success'])->name('sellingform.success')->middleware('auth');



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group( function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('newadmin',[DashboardController::class,'newindex'])->name('newadmin.index');
    Route::resource('productos', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('posts', PostController::class);
    Route::resource('authors', AuthorController::class);
    Route::get('authors/{author}/editimage', [AuthorController::class, 'editimage'])->name('authors.editimage');
    Route::resource('postcategories', PostCategoryController::class);
});



Route::get('/tienda',[ShopController::class, 'index'])->name('shop.index');

Route::get('/productos/{product}',[SingleProductController::class, 'show'])->name('product.show');

Route::get('/formulario-venta',[SellingFormController::class,'showform'])->name('sellingformold.show');


//Single que ocupo
Route::get('/single-product/{product}',[SingleProductController::class,'singleShow'])->name('single.show');
//Tienda Test
Route::get('/new-tienda',[SingleProductController::class,'loop'])->name('loop.index');


//Test Image CKEditor5*/
Route::post('image-upload', [ImageUploadController::class, 'storeImage'])->name('image.upload');

//Main Image for the post
Route::post('post/{post}/photo',[PostController::class, 'storeImage'])->name('mainimage.store');
Route::delete('post/{post}',[PostController::class, 'destroyImage'])->name('mainimage.destroy');

//Blog Routes
Route::get('/blog',[PostController::class, 'blog'])->name('post.blog');
Route::get('/entradas/{post}',[PostController::class, 'show'])->name('post.show');

//Authors Routes
Route::get('/autores',[AuthorController::class, 'archive'])->name('author.index');

//Post Categories
Route::get('/categorias-posts',[PostCategoryController::class, 'archive'])->name('postcategories.archive');

//Rutas para entrar a post de un autor o de una categoria
Route::get('/entradas/autor/{author}',[PostController::class, 'authorPost'])->name('authorpost.index');
Route::get('/entradas/categoria/{postcategory}',[PostController::class, 'categoryPost'])->name('categorypost.index');

//Test API Chilexpress Route
Route::get('/chilexpress',[ChilexpressController::class, 'index'])->name('api.index');



//Test Checkout
Route::get('tienda/{product}/checkout',[CheckoutController::class,'index'])->name('checkout.index');

//Test Order End
Route::get('order-end',[WebpayPlusController::class,'commitTransaction'])->name('order.index');

Route::post('/checkout/create', [WebpayPlusController::class, 'createdTransaction'])->name('create.webpay');
// Route::any('/checkout/returnUrl', [WebpayPlusController::class, 'commitTransaction']);
Route::get('/checkout/refund', [WebpayPlusController::class, 'showRefund']);
Route::post('/checkout/refund', [WebpayPlusController::class, 'refundTransaction']);
Route::get('/checkout/transactionStatus', [WebpayPlusController::class, 'showGetStatus']);
Route::post('/checkout/transactionStatus', [WebpayPlusController::class, 'getTransactionStatus']);



//Test Pagination
Route::get('/pagination', function () {
    return view('tests.pagination');
});


//CART MIDDLEWARE
Route::middleware(['check.user.type'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
});

//New Cart test Vue JS before add middleware and real actions
Route::get('/newcart',[CartController::class,'newcart'])->name('newcart.index');


//Rutas para Carlos
Route::get('/',[PagesController::class, 'inicio'])->name('inicio');
Route::get('/nosotros',[PagesController::class, 'nosotros'])->name('nosotros');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

//Ruta Terms and conditions
Route::get('/terminos-y-condiciones',[PagesController::class,'terms'])->name('terms');


//Ruta Landing
Route::get('/landing',[PagesController::class,'landing'])->name('landing');

//Ruta Forget password
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.reset.email');
