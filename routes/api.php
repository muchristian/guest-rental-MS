<?php

use Illuminate\Http\Request;
use App\Mail\TestEmail;
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
date_default_timezone_set("africa/Kigali");

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('signup', 'AuthController@signup')->name('signup');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::get('me', 'AuthController@getAuthUser')->name('me');
    Route::post('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
});

Route::group(['middleware' => ['jwt.verify', 'verifyToken', 'admin']], function () {
    Route::get('roles', 'RoleController@getAllRoles');
    Route::post('role/{id}', 'RoleController@assignRole');
});

Route::get('testmail', function() {
    $data = ['message' => 'This is a test!'];
    $mail = Mail::to('mucyochristian2@gmail.com')->send(new TestEmail($data));
});

