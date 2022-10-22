<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){ //...
// NOTE!! That the prefix is admin for all file routes.
Route::group(['namespace'=> 'Admin', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function(){
    Route::get('dashboard', [DashboardController::class, 'index']) -> name('admin.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['prefix' => 'settings'], function(){
       Route::get('shipping-methods/{type}', [SettingsController::class, 'editShippingMethods'])->name('edit.shipping.methods');
       Route::post('shipping-methods/{id}', [SettingsController::class, 'updateShippingMethods'])->name('update.shipping.methods');
    });

    Route::group(['prefix' => 'profile'], function (){
        Route::get('edit', [ProfileController::class, 'editProfile']) -> name('admin.profile.edit');
        Route::put('update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
       // Route::put('update/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password.update');
    });
});



Route::group(['namespace'=> 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function(){
        Route::get('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('login', [LoginController::class, 'checkAdmin'])->name('admin.check.admin');
    });

});




