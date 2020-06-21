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
    Route::post('user-registration', 'AuthController@userRegistration')->name('user-registration');
    Route::post('signup', 'AuthController@primaryRegistration');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::get('me', 'AuthController@getAuthUser')->name('me');
    Route::post('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
});

Route::group([
    'middleware' => ['jwt.verify', 'verifyToken', 'super_admin']
    ], function() {
        Route::get('users', 'UserController@getAllUsers');
        Route::get('user/{id}', 'UserController@getOneUser');
        Route::put('guest-house/update/{id}', 'GuestHouseController@updateGuestHouse');
        Route::get('guest-house', 'GuestHouseController@getGuestHouse');
        Route::put('guest-house/status/{id}', 'GuestHouseController@updateGuestHouseStatus');
        Route::delete('guest-house/delete/{id}', 'GuestHouseController@deleteGuestHouse');
        
    });
Route::post('guest-house/create', 'GuestHouseController@createGuestHouse');

Route::group(['middleware' => ['jwt.verify', 'verifyToken', 'admin']], function () {
    Route::get('roles', 'RoleController@getAllRoles');
    Route::post('role/{id}', 'RoleController@assignRole');
});


