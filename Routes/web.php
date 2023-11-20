<?php

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

use Illuminate\Support\Facades\Route;

Route::prefix('panel')->group(function() {
    Route::resource('PortfolioCategory', 'PortfolioCategoryController');
    Route::post('PortfolioCategory-sort', 'PortfolioCategoryController@sort_item')->name('PortfolioCategory-sort');

    Route::resource('portfolios', 'PortfolioController');
    Route::get('portfolios-photo-delete/{photo}', 'PortfolioController@photo_destroy')->name('portfolios-photo-delete');
});
