<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('unauth',function(){
    return view('unauth');
});
Route::get('/user/{id}',[UserController::class, 'getUser']);
Route::get('/course',[CourseController::class, 'index']);
Route::get('/course/{id}',[CourseController::class, 'findCourse'])->middleware('checkHeaders');
