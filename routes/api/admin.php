<?php
use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Route;

//api quan ly
Route::group(['prefix'=>'admin/api','as'=>'admin.api.'], function () {
    Route::middleware('auth')->group(function () {        
        Route::group(['prefix'=>'categories','as'=>'categories.'], function () {
            Route::put('change-status/{id?}', [CategoryController::class, 'changeStatus'])->name('changeStatus');
            Route::delete('delete', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });
});