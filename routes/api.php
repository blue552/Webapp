<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

// API Routes for Products
Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::post('/products', [ProductApiController::class, 'store']);
Route::put('/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

// Or use resource route (uncomment if you prefer)
// Route::apiResource('products', ProductApiController::class);

