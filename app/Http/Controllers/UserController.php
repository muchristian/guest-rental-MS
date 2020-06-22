<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;

class UserController extends Controller
{
    public function getAllUsers() {
        $users = User::where(function ($query) {
            $query->where('role', 'ADMIN');
            $query->orWhere('role', 'MANAGER');
        })->paginate(10);
        return UserResource::collection($users);
    }

    public function getOneUser($id) {
        $user = User::find($id);
        if (!$user) {
            return ResponseHandler::errorResponse(
                'A passed user not found',
                Response::HTTP_BAD_REQUEST
              ); 
        }
        return new UserResource($user);
    }
}
