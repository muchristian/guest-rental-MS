<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ResponseHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Helper\RoleHelper;

class RoleController extends Controller
{
    public function getAllRoles() {
        return ResponseHandler::successResponse(
            'Successfully returned all roles',
            Response::HTTP_OK,
            RoleHelper::Roles(),
            null
        );
    }

    public function assignRole(Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            return ResponseHandler::errorResponse(
                'Requested user does not exist',
                Response::HTTP_BAD_REQUEST
            );
        }
        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseHandler::errorResponse(
                'Please fill out the role',
                Response::HTTP_BAD_REQUEST
            );
        }

        if (!in_array($request->role, RoleHelper::Roles())){
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
