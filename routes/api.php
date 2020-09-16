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
    Route::post('second-signup', 'AuthController@secondRegistration');
    Route::post('signup', 'AuthController@firstRegistration');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::get('me', 'AuthController@getAuthUser')->name('me');
    Route::post('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
});

Route::group([
    'prefix' => 'super_admin',
    'middleware' => ['jwt.verify', 'verifyToken', 'super_admin']
    ], function() {
    Route::get('users', 'UserController@getAllUsers');
    Route::get('user/{username}', 'UserController@getOneUser');
    Route::get('user/edit/{username}', 'UserController@editUser');
    Route::put('user/update/{username}', 'UserController@updateUser');
    Route::delete('user/delete/{username}', 'UserController@deleteUser');
    

    Route::get('roles', 'RoleController@getAllRoles');
    Route::put('role/{username}', 'RoleController@assignRole');
    
    
    Route::get('guest-houses', 'GuestHouseController@getGuestHouse');
    Route::get('guest-house/{name}', 'GuestHouseController@getOneHouse');
    Route::get('guest-house/edit/{name}', 'GuestHouseController@editHouse'); 
    Route::get('guest-houses/pending', 'GuestHouseController@getPendingGuestHouses');
    Route::get('guest-houses/approved', 'GuestHouseController@getApprovedGuestHouses');
    Route::post('guest-house/create', 'GuestHouseController@createGuestHouse');
    Route::put('guest-house/update/{name}', 'GuestHouseController@updateGuestHouse');
    Route::put('guest-house/update/status/{name}', 'GuestHouseController@updateGuestHouseStatus');
    Route::delete('guest-house/delete/{name}', 'GuestHouseController@deleteGuestHouse');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['jwt.verify', 'verifyToken', 'admin']], function () {
    Route::get('user/{username}', 'UserController@getOneUser');
    Route::get('user/edit/{username}', 'UserController@editUser');
    Route::put('user/update/{username}', 'UserController@updateUser');
    Route::get('users/staff', 'UserController@getGHStaff');

    Route::get('roles', 'RoleController@getAllRoles');
    Route::put('role/{username}', 'RoleController@assignRole');

    Route::get('guest-house/edit/{name}', 'GuestHouseController@editHouse');
    Route::put('guest-house/update/{name}', 'GuestHouseController@updateGuestHouse');
    
    Route::post('room/create', 'RoomController@createRoom');
    Route::get('room/{room_name}', 'RoomController@getOneRoom');
    Route::get('rooms', 'RoomController@getRooms');
    Route::get('rooms/active', 'RoomController@getActiveRooms');
    Route::get('rooms/inactive', 'RoomController@getInactiveRooms');
    Route::get('room/edit/{room_name}', 'RoomController@editRoom');
    Route::put('room/update/{room_name}', 'RoomController@updateRoom');
    Route::put('room/update/status/{room_name}', 'RoomController@updateRoomStatus');
    Route::delete('room/delete/{room_name}', 'RoomController@deleteRoom');


    Route::post('guest/create', 'GuestController@createGuest');
    Route::get('guest/{first_name}', 'GuestController@getOneGuest');
    Route::get('guests', 'GuestController@getGuests');
    Route::get('guests/active', 'GuestController@getActiveGuests');
    Route::get('guests/inactive', 'GuestController@getInactiveGuests');
    Route::get('guest/edit/{first_name}', 'GuestController@editGuest');
    Route::put('guest/update/{first_name}', 'GuestController@updateGuest');
    Route::put('guest/update/status/{first_name}', 'GuestController@updateGuestStatus');
    Route::delete('guest/delete/{first_name}', 'GuestController@deleteGuest');

    Route::post('service/create', 'ServiceController@createService');
    Route::get('service/{service_name}', 'ServiceController@getOneService');
    Route::get('services', 'ServiceController@getServices');
    Route::get('service/edit/{service_name}', 'ServiceController@editService');
    Route::put('service/update/{service_name}', 'ServiceController@updateService');
    Route::delete('service/delete/{service_name}', 'ServiceController@deleteService');

    Route::post('services/assign', 'GuestController@guestServicesAssign');
    Route::put('services/assigned/{guest_fk}/update', 'GuestController@updateGuestAssignedServices');
    Route::delete('services/assigned/{guest_fk}/delete', 'GuestController@deleteGuestAssignedServices');
});
Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');


