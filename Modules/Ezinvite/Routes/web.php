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

Route::get('/invite', 'EzinviteController@invite')->name('invite');

Route::middleware('auth')->group(function () {
    Route::prefix('credits')->group(function() {
        Route::get('/', 'EzinviteController@historyCredit')->name('history');
    });

    Route::prefix('invite-coupon')->group(function() {
        Route::get('/', 'EzinviteController@index')->name('invite-coupon');
        Route::post('/add-credit', 'EzinviteController@getCredit')->name('getCredit');
    });

    Route::middleware('can:admin')->prefix('coupons')->name('coupons.')->group(function () {
        Route::get('/', 'CouponController@index')->name('index');
        Route::get('/create', 'CouponController@create')->name('create');
        Route::post('/create', 'CouponController@store')->name('doCreate');
        Route::get('/show/{coupon}', 'CouponController@show')->name('show');
        Route::put('/edit/{coupon}', 'CouponController@edit')->name('edit');
        Route::delete('/delete/{coupon}', 'CouponController@destroy')->name('delete');
    });
});


