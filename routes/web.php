<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function(){
	return view('index');
})->name('index');

Route::middleware('guest')->prefix('auth')->name('auth.')->group(function(){
    Route::get('/login', [AuthController::class,'loginpage'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.store');
    Route::get('/register',[AuthController::class,'registerpage'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.store');
});
