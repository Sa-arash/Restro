<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main',[\App\Http\Controllers\FrontController::class,'main']);
