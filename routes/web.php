<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('login',[AuthController::class,'login'])->name('login');
Route::resource('/',AuthController::class);

Route::group(['middleware'=>'auth'],function(){

    Route::resource('home',HomeController::class);
    Route::resource('comments',CommentController::class);
});