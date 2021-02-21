<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController; 

Route::group(['prefix'=>'quan-ly','as'=>'admin.'], function () {
    Route::get('dang-nhap', [LoginController::class, 'index'])->name('login');
    Route::post('dang-nhap', [LoginController::class, 'authenticate'])->name('login');
    Route::middleware('auth')->group(function () {
        Route::get('dang-xuat', [LoginController::class, 'logout'])->name('logout');
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        
        //route category
        Route::group(['prefix'=>'danh-muc-san-pham','as'=>'categories.'], function () {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::get('them-moi', [CategoryController::class, 'create'])->name('create');
            Route::get('chinh-sua/{url?}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('them-moi', [CategoryController::class, 'store'])->name('store');
            Route::put('thay-doi-trang-thai', [CategoryController::class, 'changeStatus'])->name('changeStatus');
            Route::post('cap-nhat', [CategoryController::class, 'update'])->name('update');
        });
    });
});



