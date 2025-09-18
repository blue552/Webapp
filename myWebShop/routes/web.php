<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/',[ProductController::class,'index'])->name('index');
    Route::get('/create',[ProductController::Class,'create'])->name('create');
    Route::post('/',[ProductController::class,'store'])->name('store');
    Route::get('/{id}',[ProductController::class,'show'])->name('show');
    Route::get('/{id}/edit',[ProductController::class,'edit'])->name('edit');
    Route::put('/{id}',[ProductController::class,'update'])->name('update');
    Route::delete('/{id}',[ProductController::class,'destroy'])->name('destroy');
});
