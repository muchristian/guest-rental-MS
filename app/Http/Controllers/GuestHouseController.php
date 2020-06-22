<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\GuestHouse;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\Http\Resources\GuestHouseResource;
use App\Helper\mailHelper;

class GuestHouseController extends Controller
{

    use mailHelper;


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
        try {
        $guestHouse = GuestHouse::find($id);
        if (!$guestHouse) {
            return ResponseHandler::errorResponse(
                'A passed guest house not found',
                Response::HTTP_BAD_REQUEST
              ); 
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:guest_houses',
            'city' => 'required',
            'sector' => 'required',
            'logo' => 'max:10000|mimes:png,svg',
            'status' => ['required', 'regex:/^pending$|^approved$|^rejected$/']
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
        $status = $guestHouse->status;
        $guestHouse->update([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'location' => $request->city."-".$request->sector,
            'status' => $request->status
        ]);
        if ($request->status === $status) {
            return ResponseHandler::successResponse(
                'Guest house updated successfully, but is already assigned to that status', 
                Response::HTTP_OK,
                null,
                null
            );
        }
        switch($request->status) {
            case 'approved':   
                $this->sendMail('guest_house.approved',
                    $guestHouse->users[0]->firstName, 
                    $guestHouse->users[0]->email, 
                    'announcing email for approval',
                    null, 
                    null
                );
                return ResponseHandler::successResponse(
                    'Guest house updated successfully with approved status', 
                    Response::HTTP_OK,
                    null,
                    null
                );
            case 'rejected':
                $this->sendMail('guest_house.rejected',
                    $guestHouse->users[0]->firstName, 
                    $guestHouse->users[0]->email, 
                    'announcing email for rejected',
                    null, 
                    null
                );
                if ($guestHouse) {
                    $guestHouse->delete();
                }
                return ResponseHandler::successResponse(
                    'Guest house updated successfully with rejected status', 
                    Response::HTTP_OK,
                    null,
                    null
                );
            default:
            return ResponseHandler::successResponse(
                'Guest house updated successfully with pending status', 
                Response::HTTP_OK,
                null,
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



    public function updateGuestHouseStatus(Request $request, $id) {
        try {
        $guestHouse = GuestHouse::find($id);
        if (!$guestHouse) {
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
                $this->sendMail('guest_house.approved',
                    $guestHouse->users[0]->firstName, 
                    $guestHouse->users[0]->email, 
                    'announcing email for approval',
                    null, 
                    null
                );
                return ResponseHandler::successResponse(
                    'your Guest house were approved successfully', 
                    Response::HTTP_OK,
                    null,
                    null
                );
            case 'rejected':
                $this->sendMail('guest_house.rejected',
                    $guestHouse->users[0]->firstName, 
                    $guestHouse->users[0]->email, 
                    'announcing email for rejected',
                    null, 
                    null
                );
                if ($guestHouse) {
                    $guestHouse->delete();
                }
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
                    null,
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



    public function deleteGuestHouse($id) {
        $guestHouse = GuestHouse::find($id);
        if (!$guestHouse) {
            return ResponseHandler::errorResponse(
                'A passed guest house not found',
                Response::HTTP_BAD_REQUEST
              ); 
        }
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
