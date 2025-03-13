<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/home',[\App\Http\Controllers\FrontController::class,'main'])->name('home');
Route::get('/menu',[\App\Http\Controllers\FrontController::class,'menu'])->name('menu');
Route::get('/about',[\App\Http\Controllers\FrontController::class,'about'])->name('about');
Route::get('/product/{id}',[\App\Http\Controllers\FrontController::class,'productPage'])->name('product.page');
Route::get('/cart',[\App\Http\Controllers\FrontController::class,'cart'])->name('cart.page');
Route::post('/payment',[\App\Http\Controllers\FrontController::class,'payment'])->name('payment.url');
Route::get('/darga',[\App\Http\Controllers\FrontController::class,'darga'])->name('darga.url');
