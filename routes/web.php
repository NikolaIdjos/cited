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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

/**
 * Landing
 */
Route::get('/', 'HomeController@landing');
/**
 * Auth middleware and prefix
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    /**
     * Quotes
     */
    Route::resource('/quotes', 'QuoteController')->only(['index']);
    /**
     * Users
     */
    Route::get('index/users', 'UserController@indexData');
    Route::resource('/users', 'UserController')->only(['index']);
    /**
     * Subscribers
     */
    Route::get('index/subscribers', 'SubscriberController@indexData');
    Route::resource('/subscribers', 'SubscriberController')->only(['index']);
});
