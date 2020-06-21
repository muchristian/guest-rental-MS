<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\GuestHouse;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\Http\Resources\GuestHouseResource;

class GuestHouseController extends Controller
{
    public function createGuestHouse(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:guest_houses',
            'city' => 'required',
            'sector' => 'required',
            'logo' => 'max:10000|mimes:png,svg'
          ]);
    
        if ($validator->fails()) {
            return ResponseHandler::errorResponse(
              $validator->errors(),
              Response::HTTP_BAD_REQUEST
            );
          }
        $file = $request->file('logo');
        if ($file) {
        $filename = $file->getClientOriginalName();
        $img = $file->move(public_path('uploads'), $filename); 
        $guestHouse = GuestHouse::create([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'logo' => $img,
            'location' => $request->city."-".$request->sector,
        ]);
        }
        $guestHouse = GuestHouse::create([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'location' => $request->city."-".$request->sector,
        ]);

        return ResponseHandler::successResponse(
            'Guest house registed successfully', 
            Response::HTTP_CREATED, 
            $guestHouse,
            null
        );
    }

    public function updateGuestHouse(Request $request, $id) {
        $check = GuestHouse::find($id);
        if (!$check) {
            return ResponseHandler::errorResponse(
                'A passed guest house not found',
                Response::HTTP_BAD_REQUEST
              ); 
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:guest_houses',
            'city' => 'required',
            'sector' => 'required',
            'logo' => 'max:10000|mimes:png,svg'
          ]);
    
        if ($validator->fails()) {
            return ResponseHandler::errorResponse(
              $validator->errors(),
              Response::HTTP_BAD_REQUEST
            );
          }

        $file = $request->file('logo');
        if ($file) {
            $filename = $file->getClientOriginalName();
        $img = $file->move(public_path('uploads'), $filename); 
        $guestHouse = GuestHouse::where('id', $id)
        ->update([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'logo' => $img,
            'location' => $request->city."-".$request->sector,
            'status' => $request->status
        ]);
        }

        $guestHouse = GuestHouse::where('id', $id)
        ->update([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'location' => $request->city."-".$request->sector,
            'status' => $request->status
        ]);

        return ResponseHandler::successResponse(
            'Guest house updated successfully', 
            Response::HTTP_OK,
            null,
            null
        );
    }

    public function updateGuestHouseStatus(Request $request, $id) {
        $check = GuestHouse::find($id);
        if (!$check) {
            return ResponseHandler::errorResponse(
                'A passed guest house not found',
                Response::HTTP_BAD_REQUEST
              ); 
        }
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'regex:/^pending$|^approved$|^rejected$/'],
          ]);
    
        if ($validator->fails()) {
            return ResponseHandler::errorResponse(
              'Status should be pending | approved | rejected',
              Response::HTTP_BAD_REQUEST
            );
          }
        $guestHouse = GuestHouse::where('id', $id)
        ->update([
            'status' => $request->status
        ]);

        switch($request->status) {
            case 'approved':
                return ResponseHandler::successResponse(
                    'your Guest house were approved successfully', 
                    Response::HTTP_OK,
                    null,
                    null
                );
            case 'rejected':
                return ResponseHandler::successResponse(
                    'Unfortunately your guest house were rejected', 
                    Response::HTTP_OK,
                    null,
                    null
                );
            default:
                return ResponseHandler::successResponse(
                    'Guest house status updated successfully', 
                    Response::HTTP_OK,
                    null,
                    null
                );
        }
    }

    public function deleteGuestHouse($id) {
        $guestHouse = GuestHouse::find(1);
        $guestHouse->delete();
        return ResponseHandler::successResponse(
            'Guest house deleted successfully', 
            Response::HTTP_OK,
            null,
            null
        );
    }

    public function getGuestHouse() {
        $guestHouse = GuestHouse::paginate(6);
        return ResponseHandler::successResponse(
            'All Guest house returned successfully', 
            Response::HTTP_OK,
            GuestHouseResource::collection($guestHouse),
            null
        );
    }
}
