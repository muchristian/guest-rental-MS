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

date_default_timezone_set("africa/Kigali");

Route::get('/', function () {
    return "welcome dude";
});
Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('user/reset_password/{reset_code}', 'AuthController@resetPassword');