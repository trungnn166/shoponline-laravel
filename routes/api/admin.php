<?php

use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use Illuminate\Support\Facades\Route;

//api quan ly
Route::group(['prefix'=>'admin/api','as'=>'admin.api.'], function () {
    Route::middleware('auth')->group(function () {     
        //category api   
        Route::group(['prefix'=>'categories','as'=>'categories.'], function () {
            Route::put('change-status/{id?}', [CategoryController::class, 'changeStatus'])->name('changeStatus');
            Route::delete('delete', [CategoryController::class, 'destroy'])->name('destroy');
        });
        //brand api
        Route::group(['prefix'=>'brands','as'=>'brands.'], function () {
            Route::put('change-status/{id?}', [BrandController::class, 'changeStatus'])->name('changeStatus');
            Route::delete('delete', [BrandController::class, 'destroy'])->name('destroy');
        });
        //product api
        Route::group(['prefix'=>'products','as'=>'products.'], function () {
            Route::put('change-status/{id?}', [ProductController::class, 'changeStatus'])->name('changeStatus');
            Route::delete('delete', [ProductController::class, 'destroy'])->name('destroy');
        });

        //product images api
        Route::group(['prefix'=>'product-images','as'=>'products.images'], function () {
            Route::post('store', [ProductImageController::class, 'store'])->name('store');
            Route::delete('delete', [ProductImageController::class, 'destroy'])->name('destroy');
        });
    });
});

