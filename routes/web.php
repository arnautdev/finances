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
});

Route::namespace('App\Http\Controllers\\')
    ->prefix('dashboard')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {

//        Route::get('/home', function () {
//            return view('dashboard');
//        })->name('dashboard');

        Route::get('/home', 'DashboardController@index')->name('dashboard');
        Route::resource('expenses', 'ExpensesController');
        Route::resource('monthly-reports', 'MonthlyReportsController');
    });
