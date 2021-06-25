<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailsBannerController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/view-details/{id}', [HomeController::class, 'view_details'])->name('view_details');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::view('/home', 'home')->name('home');

    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::get('/display' ,[HomeController::class,'getCategoryByProduct'])->name('display_product');

    Route::resource('home-banner',HomeBannerController::class);
    Route::resource('details-banner',DetailsBannerController::class);

});



