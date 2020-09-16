<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserGetOneResource;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Support\Facades\Validator;
use App\Helper\UpdateValidationHelper;

class UserController extends Controller
{
    public function getAllUsers() {
        $users = User::where(function ($query) {
            $query->where('role', 'ADMIN');
            $query->orWhere('role', 'MANAGER');
        })->paginate(10);
        return ResponseHandler::successResponse(
            'All users returned successfully', 
            Response::HTTP_OK,
            UserResource::collection($users),
            null
        );
    }

    public function getGHStaff(Request $request) {
        $users = User::where('role', '!=', 'ADMIN')
        ->where('guest_house_fk', $request->token->guest_house_fk)
        ->get();
        return ResponseHandler::successResponse(
            'All manager returned successfully', 
            Response::HTTP_OK,
            UserResource::collection($users),
            null
        );
    }


    public function getOneUser($username) {
        $user = User::where('username', $username)->firstOrFail();
        return ResponseHandler::successResponse(
            'A user returned successfully', 
            Response::HTTP_OK,
            new UserGetOneResource($user),
            null
        );
    }

    public function editUser($username) {
        $user = User::where('username', $username)->firstOrFail();
        return ResponseHandler::successResponse(
            'A user returned successfully', 
            Response::HTTP_OK,
            $user,
            null
        );
    }

    public function updateUser(RegistrationFormRequest $request, $username) {
        $user = User::where('username', $username)->firstOrFail();
        $user->update([
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'username' => $request->username,
        'email' => $request->email,
        'phoneNumber' => $request->phoneNumber,
        'gender' => $request->gender,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        ]);
        return ResponseHandler::successResponse(
            'A user updated successfully', 
            Response::HTTP_OK,
            new UserResource($user),
            null
        );
    }


    public function deleteUser($username) {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();
        return ResponseHandler::successResponse(
            'A user deleted successfully', 
            Response::HTTP_OK,
            null,
            null
        );
    }
}
