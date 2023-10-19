<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/brand-list",[BrandController::class,'brandList']);
Route::get("/category-list",[CategoryController::class,'categoryList']);
Route::get("/productByCategory/{id}",[ProductController::class,'listProductByCategory']);
Route::get("/product-by-brand/{id}",[ProductController::class,'listProductByBrand']);
Route::get("/product-by-remark/{remark}",[ProductController::class,'listProductByRemark']);
Route::get("/product-slider",[ProductController::class,'listProductSlider']); 
Route::get("/product-details/{id}",[ProductController::class,'listProductDetails']); 
Route::get("/product-review/{product_id}",[ProductController::class,'ProductReview']); 


//Auth Route

Route::get('/user-login/{email}',[UserController::class,'userLogin']);
Route::get('/otp-verify/{email}/{otp}',[UserController::class,'loginVerify']);
Route::get('/user-logout',[UserController::class,'userLogOut']);

// user insert
Route::post('/profile-create',[ProfileController::class,'profileCreate'])->middleware(TokenAuthenticate::class);
Route::get('/profile-read',[ProfileController::class,'readProfile'])->middleware(TokenAuthenticate::class);

// product review
Route::post('/create-review',[ProductController::class,'createReview'])->middleware(TokenAuthenticate::class);

// product wishlist
Route::get('/product-wish-list',[ProductController::class,'productWish'])->middleware(TokenAuthenticate::class);
Route::get('/product-wish-create/{product_id}',[ProductController::class,'productWishCreate'])->middleware(TokenAuthenticate::class);
Route::get('/product-wish-remove/{product_id}',[ProductController::class,'productWishRemove'])->middleware(TokenAuthenticate::class);

// product cart

Route::post('/product-cart-create',[ProductController::class,'cartCreate'])->middleware(TokenAuthenticate::class);
Route::get('/product-cart-list',[ProductController::class,'cartList'])->middleware(TokenAuthenticate::class);
Route::get('/product-remove-cart/{product_id}',[ProductController::class,'productRemoveCart'])->middleware(TokenAuthenticate::class);

// Invoice and Payment

Route::post('/invoice-create',[InvoiceController::class,'invoiceCreate'])->middleware( TokenAuthenticate::class);