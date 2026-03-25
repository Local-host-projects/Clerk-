<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgentProfileController;
use App\Http\Controllers\MerchantProfileController;
use App\Http\Controllers\ProductsController;


Route::get('/', function(){
    if(Auth::check()){
        return redirect()->route('merchant.projects');
    }
	return view('index');
})->name('index');
Route::get('/registeration-dashboard/{role}', [AuthController::class,'middleware'])->name('createRole')->middleware('auth');
Route::middleware('guest')->prefix('auth')->name('auth.')->group(function(){
    Route::get('/login', [AuthController::class,'loginpage'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.store');
    Route::get('/register',[AuthController::class,'registerpage'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.store');
});
Route::middleware(['auth'])->prefix('merchant')->name('merchant.')->group(function(){
    Route::get('/projects',[MerchantProfileController::class,'projects'])->name('projects')->middleware('merchant');
    Route::get('/products',[MerchantProfileController::class,'products'])->name('products')->middleware('merchant');
    Route::post('/create-merchant-profile',[MerchantProfileController::class,'store'])->name('profile.store');
    Route::post('/create-physical-goods',[ProductsController::class,'createPhysicalGood'])->name('create.physical.product');
    Route::post('/create-digital-goods',[ProductsController::class,'createDigitalGood'])->name('create.digital.product');
});
Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function(){
    Route::post('/create-agent-profile',[AgentProfileController::class,'store'])->name('profile.store')->middleware('agent');
});
