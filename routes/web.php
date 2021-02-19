<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController; 

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

Route::get('/', [HomeController::class, 'index']);


//Quan ly
Route::group(['prefix'=>'quan-ly','as'=>'admin.'], function () {
    Route::get('dang-nhap', [LoginController::class, 'index'])->name('login');
    Route::post('dang-nhap', [LoginController::class, 'authenticate'])->name('login');
    Route::middleware('auth')->group(function () {
        Route::get('dang-xuat', [LoginController::class, 'logout'])->name('logout');
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        
        //route category
        Route::group(['prefix'=>'/danh-muc-san-pham','as'=>'categories.'], function () {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::get('them-moi', [CategoryController::class, 'create'])->name('create');
            Route::post('them-moi', [CategoryController::class, 'store'])->name('store');
        });
    });
});
