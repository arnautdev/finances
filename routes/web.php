<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::namespace('App\Http\Controllers\\User\\')
    ->prefix('user')
    ->middleware(['auth:sanctum', 'verified'])->group(function () {

        Route::resource('profile', 'ProfileController');
        Route::resource('change-password', 'ChangePasswordController');

    });

Route::namespace('App\Http\Controllers\\')
    ->prefix('dashboard')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {

        Route::get('/home', 'DashboardController@index')->name('dashboard');
        Route::resource('goal', 'GoalController');
        Route::resource('goal-action', 'GoalActionController');
        Route::resource('expenses', 'ExpensesController');

        Route::resource('yearly-preview', 'YearlyPreviewController');
        Route::resource('monthly-reports', 'MonthlyReportsController');
        Route::get('/monthly-reports/{category}/show', 'MonthlyReportsController@showByCategory')
            ->name('monthly-reports.category');

        Route::resource('expenses-categories', 'ExpensesCategoriesController');
        Route::resource('add-expense', 'AddExpenseController');
        Route::get('/add-expense/{expense}/setAmountModal', 'AddExpenseController@setAmountModal')->name('setAmountModal');
        Route::resource('todo', 'TodoListController');
        Route::post('/todo/{todo}/markAsDone', 'TodoListController@markAsDone')->name('todo.markAsDone');


        // get user unread notifications
        Route::get('/notifications', function () {
            $user = auth()->user();
            return [
                'countUnreadNotifications' => $user->unreadNotifications()->count(),
                'notifications' => $user->unreadNotifications()->take(5)->get()
            ];
        });
        Route::get('/notifications/all', 'NotificationsController@index')->name('notifications.all');
    });

Auth::routes();
Route::get('auth/{service}', 'App\Http\Controllers\Auth\SocialAuthController@redirect');
Route::get('auth/{service}/callback', 'App\Http\Controllers\Auth\SocialAuthController@callback');
