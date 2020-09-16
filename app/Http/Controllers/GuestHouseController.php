<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\GuestHouse;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\Http\Resources\GuestHouseResource;
use App\Http\Resources\GuestHouseGetOneResource;
use App\Helper\mailHelper;
use App\Helper\UploadHelper;
use App\Http\Requests\GuestHouseRequest;
use App\Http\Requests\UpdateGHStatusRequest;
use App\Events\GHStatusApprovedUpdate;
use App\Events\GHStatusRejectedUpdate;

class GuestHouseController extends Controller
{

    use mailHelper;


    public function createGuestHouse(GuestHouseRequest $request) {
        $guestHouse = GuestHouse::create([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'logo' => UploadHelper::fileUpload($request->file('logo'), 'upload'),
            'location' => $request->city."-".$request->sector,
        ]);
        return ResponseHandler::successResponse(
            'Guest house registed successfully', 
            Response::HTTP_CREATED, 
            new GuestHouseResource($guestHouse),
            null
        );
    }


    public function updateGuestHouse(GuestHouseRequest $request, $name) {
        $guestHouse = GuestHouse::where('name', $name)->firstOrFail();
        
        $guestHouse->update([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'logo' => UploadHelper::fileUpload($request->file('logo'), 'upload'),
            'location' => $request->city."-".$request->sector
        ]);
        return ResponseHandler::successResponse(
            'A guest house updated successfully', 
            Response::HTTP_OK,
            new GuestHouseResource($guestHouse),
            null
        );
    }


    public function updateGuestHouseStatus(UpdateGHStatusRequest $request, $name) {
        try {
        $guestHouse = GuestHouse::where('name', $name)->firstOrFail();
        $status = $guestHouse->status;
        $guestHouse->update([
            'status' => $request->status
        ]);
        if ($request->status === $status) {
            return ResponseHandler::successResponse(
                'Guest house status updated successfully, but is already assigned to that status', 
                Response::HTTP_OK,
                null,
                null
            );
        }
        
        switch($request->status) {
            case 'approved': 
                event(new GHStatusApprovedUpdate($guestHouse));
                return ResponseHandler::successResponse(
                    'Guest house status updated to approved successfully', 
                    Response::HTTP_OK,
                    new GuestHouseResource($guestHouse),
                    null
                );
            case 'rejected':
                event(new GHStatusRejectedUpdate($guestHouse));
                $guestHouse->delete();
                return ResponseHandler::successResponse(
                    'Guest house status updated to rejected successfully', 
                    Response::HTTP_OK,
                    null,
                    null
                );
            default:
            return ResponseHandler::successResponse(
                'Guest house status updated successfully as pending', 
                Response::HTTP_OK,
                new GuestHouseResource($guestHouse),
                null
            );
        }
            
        
    } catch(\Swift_TransportException $transportExp) {
        $guestHouse->update([
            'status' => $status
        ]);
        return ResponseHandler::errorResponse(
          $transportExp->getMessage(),
           Response::HTTP_BAD_REQUEST
          );
       }
    }


    public function getGuestHouse() {
        $guestHouse = GuestHouse::all();
        return ResponseHandler::successResponse(
            'All Guest house returned successfully', 
            Response::HTTP_OK,
            GuestHouseResource::collection($guestHouse),
            null
        );
    }


    public function getOneHouse($name) {
        $guestHouse = GuestHouse::where('name', $name)->firstOrFail();
        return ResponseHandler::successResponse(
            'A user returned successfully', 
            Response::HTTP_OK,
            new GuestHouseGetOneResource($guestHouse),
            null
        );
    }

    public function editHouse($name) {
        $guestHouse = GuestHouse::where('name', $name)->firstOrFail();
        return ResponseHandler::successResponse(
            'A user returned successfully', 
            Response::HTTP_OK,
            $guestHouse,
            null
        );
    }

    public function getPendingGuestHouses() {
        $guestHouse = GuestHouse::where('status', 'pending')->all();
        return ResponseHandler::successResponse(
            'All Guest house returned successfully', 
            Response::HTTP_OK,
            GuestHouseResource::collection($guestHouse),
            null
        );
    }

    public function getApprovedGuestHouses() {
        $guestHouse = GuestHouse::where('status', 'approved')->all();
        return ResponseHandler::successResponse(
            'All Guest house returned successfully', 
            Response::HTTP_OK,
            GuestHouseResource::collection($guestHouse),
            null
        );
    }
    

    public function deleteGuestHouse($name) {
        $guestHouse = GuestHouse::where('name', $name)->firstOrFail();
        $guestHouse->delete();
        return ResponseHandler::successResponse(
            'Guest house deleted successfully', 
            Response::HTTP_OK,
            null,
            null
        );
    }
}
