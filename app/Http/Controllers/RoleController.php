<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ResponseHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Helper\RoleHelper;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function getAllRoles(Request $request) {
        return ResponseHandler::successResponse(
            'Successfully returned all roles',
            Response::HTTP_OK,
            RoleHelper::Roles($request->token->role),
            null
        );
    }

    public function assignRole(RoleRequest $request, $username) {
        $user = User::where('username', $username)->firstOrFail();

        if (!in_array($request->role, RoleHelper::Roles($request->token->role))){
            return ResponseHandler::errorResponse(
                'The full filled role that does not exist',
                Response::HTTP_BAD_REQUEST
            );
        }

        if ($user->role === $request->role) {
            return ResponseHandler::errorResponse(
                'You have already assigned that role on this user',
                Response::HTTP_CONFLICT
            );
        }

        $user->update(['role' => $request->role]);
        return ResponseHandler::successResponse(
            'You successfully assigned role',
            Response::HTTP_OK,
            null,
            null
        );
    }
}
