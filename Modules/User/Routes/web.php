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

Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index');

    Auth::routes(['verify' => true]);
    
    Route::get('/force-sign-in/{user}', 'UsersController@forceSignIn');
    Route::get('/resend-invitation/{user}', 'ResendInvitationController@index');

    Route::resource('profile', 'ProfileController')->only(['index', 'update', 'destroy']);
    Route::resource('users', 'UsersController');
    Route::resource('user-group', 'UserGroupController');
    Route::resource('user-address', 'UserAddressController');
//    Route::resource('client', 'ClientsController')->only(['index', 'show', 'destroy']);


    // get user unread notifications
    Route::get('/notifications', function () {
        $user = auth()->user();
        return [
            'countUnreadNotifications' => $user->unreadNotifications()->count(),
            'notifications' => $user->unreadNotifications()->take(5)->get()
        ];
    });


    // social sign-in
//    Route::get('auth/{service}', 'Auth\SocialAuthController@redirect');
//    Route::get('auth/{service}/callback', 'Auth\SocialAuthController@callback');
});
