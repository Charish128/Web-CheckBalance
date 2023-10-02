<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['NoAuth']], function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/daftar', [LoginController::class, 'daftar']);
    Route::post('/login', [LoginController::class, 'login']);
});


// masuk ke dashboard
Route::group(['middleware' => ['Auth']], function () {
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('profile', [LoginController::class, 'profile']);
    Route::put('update_profile', [LoginController::class, 'update_profile']);


    // login sebagai admin
    Route::group(['middleware' => ['HanyaAdmin']], function (){
        Route::get('user', [UserController::class, 'index']);
        
    });


    // login sebagai user
});

