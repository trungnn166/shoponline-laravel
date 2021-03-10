<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\ProductController;

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
            Route::post('cap-nhat', [CategoryController::class, 'update'])->name('update');
        });

        //route brand
        Route::group(['prefix'=>'thuong-hieu-san-pham','as'=>'brands.'], function () {
            Route::get('', [BrandController::class, 'index'])->name('index');
            Route::get('them-moi', [BrandController::class, 'create'])->name('create');
            Route::get('chinh-sua/{url?}', [BrandController::class, 'edit'])->name('edit');
            Route::post('them-moi', [BrandController::class, 'store'])->name('store');
            Route::post('cap-nhat', [BrandController::class, 'update'])->name('update');
        });

        //route product
        Route::group(['prefix'=>'san-pham','as'=>'products.'], function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('/them-moi', [ProductController::class, 'create'])->name('create');
            Route::post('them-moi', [ProductController::class, 'store'])->name('store');
            Route::get('chinh-sua/{url?}', [ProductController::class, 'edit'])->name('edit');
            Route::post('cap-nhat', [ProductController::class, 'update'])->name('update');
        });

        //route banner
        Route::group(['prefix'=>'banner','as'=>'banners.'], function () {
            Route::get('', [BannerController::class, 'index'])->name('index');
            Route::get('/them-moi', [BannerController::class, 'create'])->name('create');
            Route::post('them-moi', [BannerController::class, 'store'])->name('store');
            Route::get('chinh-sua/{url?}', [BannerController::class, 'edit'])->name('edit');
            Route::post('cap-nhat', [BannerController::class, 'update'])->name('update');
        });
    });
});



