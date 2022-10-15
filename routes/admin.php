<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use Illuminate\Support\Facades\Route;



// NOTE!! That the prefix is admin for all file routes
Route::group(['namespace'=> 'Admin', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function(){
    Route::get('index', [DashboardController::class, 'index']) -> name('admin.dashboard');
});

Route::group(['namespace'=> 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function(){
    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login', [LoginController::class, 'checkAdmin'])->name('admin.check.admin');

});

