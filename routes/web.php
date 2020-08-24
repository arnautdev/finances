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

// set user locale
Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/', 'HomeController@index')->name('home.index');


Route::resource('contact-form', 'ContactController')->only(['store']);
Route::resource('newsletter', 'NewsletterController')->only(['store']);




Route::get('client-login', 'Auth\LoginController@showLoginForm')->name('client-login');
Route::post('client-login', 'Auth\LoginController@login')->name('client-login');

Route::get('client-register', 'Auth\RegisterController@showRegistrationForm')->name('client-register');
Route::post('client-register', 'Auth\RegisterController@register');

Route::get('auth/{service}', 'Auth\SocialAuthController@redirect');
Route::get('auth/{service}/callback', 'Auth\SocialAuthController@callback');