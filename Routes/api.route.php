<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['jwt.setting'])->group(function () {

    Route::get('setting', 'Auth\AuthController@setting');

    Route::post('login', 'Auth\AuthController@postLogin');
    Route::post('registration', 'Auth\AuthController@postRegistration');

    Route::middleware(['jwt.auth'])->group(function () {
        Route::get('user', 'Auth\AuthController@user');
        Route::get('refresh', 'Auth\AuthController@refresh');
        Route::post('logout', 'Auth\AuthController@logout');
    });
});
