<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
	return view('welcome');
});
Route::get('unauth',function(){
	return view('unauth');
});
Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::resource('products', ProductController::class)->except(['index']);

