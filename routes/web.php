<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AgentProfileController;
use App\Http\Controllers\MerchantProfileController;


Route::get('/', function(){
    if(Auth::check()){
        return redirect()->route('merchant.dashboard');
    }
	return view('index');
})->name('index');
Route::get('/registeration-dashboard/{role}', [AuthController::class,'middleware'])->name('createRole')->middleware('auth');
Route::get('/interswitch/token', [AgentProfileController::class, 'getAccessToken']);
Route::middleware('guest')->prefix('auth')->name('auth.')->group(function(){
    Route::get('/login', [AuthController::class,'loginpage'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.store');
    Route::get('/register',[AuthController::class,'registerpage'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.store');
});
Route::middleware(['auth'])->prefix('merchant')->name('merchant.')->group(function(){
    Route::get('/dashboard',[MerchantProfileController::class,'dashboard'])->name('dashboard')->middleware('merchant');
    Route::get('/profile',[MerchantProfileController::class,'profile'])->name('profile')->middleware('merchant');
    Route::get('/view-product/{id}',[MerchantProfileController::class,'showProduct'])->name('showProduct')->middleware('merchant');
    Route::get('/products',[MerchantProfileController::class,'products'])->name('products')->middleware('merchant');
    Route::post('/create-merchant-profile',[MerchantProfileController::class,'store'])->name('profile.store');
    Route::put('/update-merchant-profile',[MerchantProfileController::class,'updateMerchantProfile'])->name('profile.update');
    Route::post('/create-physical-goods',[ProductsController::class,'createPhysicalGood'])->name('create.physical.product');
    Route::post('/create-digital-goods',[ProductsController::class,'createDigitalGood'])->name('create.digital.product');
    Route::put('/update-products/{id}',[ProductsController::class,'updateProduct'])->name('update.product');
});
Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function(){
    Route::get('/panel',[AgentProfileController::class,'panel'])->name('panel')->middleware('agent');
    Route::get('/payment-register',[AgentProfileController::class,'paymentRegister'])->name('payment.register');
    Route::post('/create-agent-profile',[AgentProfileController::class,'store'])->name('profile.store');
});
Route::prefix('product')->name('product.')->group(function(){
    Route::get('/checkout/{id}',[ProductsController::class,'show'])->name('checkout');
    Route::get('/order/{id}',[MerchantProfileController::class,'order'])->name('order');
    Route::post('/create-order',[MerchantProfileController::class,'createOrder'])->name('create.order');
});
