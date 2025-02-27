<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[\App\Http\Controllers\FrontController::class,'main'])->name('home');
Route::get('/product/{id}',[\App\Http\Controllers\FrontController::class,'productPage'])->name('product.page');
