<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;

Route::resource('users', UsersController::class);
Route::get('/admins/login', [AdminController::class, 'login'])->name('login');
Route::post('/admins/login', [AdminController::class, 'check_login']);
//Route::group(['prefix' => 'admins','middleware' => 'auth'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
   
//});