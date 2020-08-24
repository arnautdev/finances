<?php


Route::prefix('store')->group(function () {
    Route::get('/', 'HomeController@index');


    Route::resource('catalog', 'CatalogController');
    Route::resource('product-params', 'ProductParamsController');
    Route::resource('product-options', 'ProductOptionsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('brands', 'BrandsController');
    Route::resource('orders', 'OrdersController');

    /// shopping cart routes
    Route::get('cart/increment', 'ShoppingCartController@increment')->name('cart.increment');
    Route::get('cart/unIncrement', 'ShoppingCartController@unIncrement')->name('cart.unIncrement');
    Route::get('cart/remove', 'ShoppingCartController@remove')->name('cart.remove');
    Route::resource('cart', 'ShoppingCartController');
});
