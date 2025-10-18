<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

// Route::apiResource('products', ProductApiController::class);
Route::get('/products',[ProductApiController::class,'index']);
Route::get('/products/{id}',[ProductApiController::class,'show']);
Route::post('/products',[ProductApiController::class,'store']);

