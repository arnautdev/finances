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

Route::prefix('common')->group(function () {
    Route::get('/', 'CommonController@index');


    Route::post('media/save-order', 'MediaController@saveMediaOrder')->name('media.save-order');
    Route::get('media/{media}', 'MediaController@deleteMedia')->name('media.destroy');
});
