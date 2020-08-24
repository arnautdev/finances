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

Route::prefix('dashboard')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard.home');

    Route::resource('text-page-section', 'TextPageSectionController');
    Route::resource('text-page', 'TextPageController');
    Route::resource('news', 'NewsController');
    Route::resource('contact-messages', 'ContactMessagesController');
    Route::resource('d-newsletter', 'NewsletterController');
    Route::resource('email-log', 'EmailLogController')->only(['index', 'show']);

    /// save orders
    Route::post('text-page/save-order', 'TextPageController@saveOrder')->name('text-page.save-order');

    // translation
    Route::get('languages', 'LanguageTranslationController@index')->name('languages');
    Route::post('translations/update', 'LanguageTranslationController@transUpdate')->name('translation.update.json');
    Route::post('translations/updateKey', 'LanguageTranslationController@transUpdateKey')->name('translation.update.json.key');
    Route::delete('translations/destroy/{key}', 'LanguageTranslationController@destroy')->name('translations.destroy');
    Route::post('translations/create', 'LanguageTranslationController@store')->name('translations.create');
});
