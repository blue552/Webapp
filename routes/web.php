<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello Railway!';
});

Route::get('/test', function () {
    return 'Test OK';
});

// Temporarily commented out complex routes to debug 505 error
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('products')->name('products.')->middleware('auth')->group(function () {
    Route::get('/',[ProductController::class,'index'])->name('index');
    Route::get('/create',[ProductController::class,'create'])->name('create');
    Route::post('/',[ProductController::class,'store'])->name('store');
    Route::get('/{id}',[ProductController::class,'show'])->name('show');
    Route::get('/{id}/edit',[ProductController::class,'edit'])->name('edit');
    Route::put('/{id}',[ProductController::class,'update'])->name('update');
    Route::delete('/{id}',[ProductController::class,'destroy'])->name('destroy');
});
require __DIR__.'/auth.php';
Route::prefix('categories')->name('categories.')->middleware('auth')->group(function () {
    Route::get('/',[CategoryController::class,'index'])->name('index');
    Route::get('/{slug}',[CategoryController::class,'show'])->name('show');
});
*/