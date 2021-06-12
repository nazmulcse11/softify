<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Frontend\UsersController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::match(['get', 'post'], '/register', function(){return redirect('/');});
Route::match(['get', 'post'], '/login', function(){return redirect('/');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Backend Routes
Route::group(['prefix'=>'admin'],function(){

    Route::match(['get','post'],'/',[AdminController::class,'login']);
    Route::group(['middleware'=>['admin']],function(){

        //Admin route
        Route::get('/dashboard',[AdminController::class,'dashboard']);
        Route::match(['get','post'],'/update-admin-details',[AdminController::class,'updateAdminDetails']);
        Route::post('/check-current-password',[AdminController::class,'checkCurrentPassword']);
	    Route::match(['get','post'],'/update-admin-password',[AdminController::class,'updateAdminPassword']);
        Route::get('/logout',[AdminController::class,'logout']);

        //Products route
        Route::get('/products',[ProductsController::class,'products']);
        Route::match(['get','post'],'/add-edit-product/{id?}',[ProductsController::class,'addEditProduct']);
        Route::get('/delete-product/{id}',[ProductsController::class,'deleteProduct']);

        //Orders route
        Route::get('/orders',[OrdersController::class,'orders']);
        Route::get('/order-details/{id}',[OrdersController::class,'orderDetails']);
        Route::post('/update-order-status',[OrdersController::class,'updateOrderStatus']);
    });     
    
});

// Frontend 

//Login register page
Route::get('/login-register',[App\Http\Controllers\Frontend\UsersController::class,'loginRegister']);

//Check email already exists or not while register
Route::match(['get','post'],'/check-email',[App\Http\Controllers\Frontend\UsersController::class,'checkEmail']);

//Register a user
Route::post('/user-register',[App\Http\Controllers\Frontend\UsersController::class,'registerUser']);

//Confirm user account from mail
Route::match(['get','post'],'/confirm/{code}',[App\Http\Controllers\Frontend\UsersController::class,'confirmAccount']);

//Login user
Route::post('/user-login',[App\Http\Controllers\Frontend\UsersController::class,'userLogin']);

//Logout user
Route::get('/user-logout',[App\Http\Controllers\Frontend\UsersController::class,'userLogout']);

//Login with socialaite
//Login with google
Route::get('/auth/google', [App\Http\Controllers\Frontend\UsersController::class,'redirectToGoogle']);
Route::get('/authorized/google/callback', [App\Http\Controllers\Frontend\UsersController::class,'handleGoogleCallback']);
//Login with facebook
Route::get('/auth/facebook', [App\Http\Controllers\Frontend\UsersController::class,'redirectToFacebook']);
Route::get('/auth/facebook/callback', [App\Http\Controllers\Frontend\UsersController::class,'handleFacebookCallback']);

// Products routes
Route::get('/',[App\Http\Controllers\Frontend\ProductsController::class,'products']);

Route::group(['middleware'=>['auth']],function(){

//Add to cart
Route::get('/add-to-cart/{id}',[App\Http\Controllers\Frontend\ProductsController::class,'addToCart']);

//Show cart items
Route::get('/cart',[App\Http\Controllers\Frontend\ProductsController::class,'cartItems']);

//Update cart item
Route::post('/update-cart-item-qty',[App\Http\Controllers\Frontend\ProductsController::class,'updateCartItemQty']);

//Delete cart item
Route::post('/delete-cart-item',[App\Http\Controllers\Frontend\ProductsController::class,'deleteCartItem']);

//Checkout page
Route::match(['get','post'],'/checkout',[App\Http\Controllers\Frontend\ProductsController::class,'checkout']);

//thanks page
Route::get('/thanks',[App\Http\Controllers\Frontend\ProductsController::class,'thanks']);

//Add edit shipping address
Route::match(['get','post'],'/add-edit-address/{id?}',[App\Http\Controllers\Frontend\ProductsController::class,'addEditAddress']);

//Delete shipping address
Route::get('/delete-shipping-address/{id?}',[App\Http\Controllers\Frontend\ProductsController::class,'deleteShippingAddress']);

});
