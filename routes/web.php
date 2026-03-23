<?php

use App\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
	return view('index');
})->name('index');

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class,'loginpage'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.store');
    Route::get('/register',[AuthController::class,'registerpage'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.store');
});
