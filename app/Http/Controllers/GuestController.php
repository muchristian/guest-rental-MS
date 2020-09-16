<?php

namespace App\Http\Controllers;

use App\Guest;
use App\GuestHouse;
use App\GuestService;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\Http\Requests\GuestRequest;
use App\Http\Requests\GuestStatusRequest;
use App\Http\Resources\GuestResource;
use App\Http\Resources\GuestGetOneResource;

class GuestController extends Controller
{
    public function createGuest(GuestRequest $request) {
        $guest_house = GuestHouse::where('id', $request->token->guest_house_fk)->first();
        foreach($guest_house->guests as $guest) {
            if ($guest->id_number === $request->id_number || $guest->phone_number === $request->phone_number) {
                return ResponseHandler::errorResponse(
                    'A guest with those credentials exist',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
        
        $guest = Guest::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'arrival_time' => $request->arrival_date." ".$request->arrival_time,
        'departure_time' => $request->departure_date." ".$request->departure_time,
        'room_fk' => $request->room_fk,
        'status' => $request->room_fk ? 'active' : 'inactive',
        'nationality' => $request->nationality,
        'id_type' => $request->id_type,
        'id_number' => $request->id_number,
        'extra_note' => $request->extra_note,
        'guest_house_fk' => $request->token->guest_house_fk,
        'inserted_by' => $request->token->id,
        'updated_by' => $request->token->id
        ]);
        DB::table('rooms')
              ->where('id', $guest->room_fk)
              ->update(['status' => 'active']);
        return ResponseHandler::successResponse(
            'You successfully created a guest',
            Response::HTTP_OK,
            new GuestResource($guest),
            null
        );
    }

    public function getOneGuest(Request $request, $first_name) {
        $guest = Guest::where('first_name', $first_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail(); 
        return ResponseHandler::successResponse(
            'A guest returned successfully',
            Response::HTTP_OK,
            new GuestGetOneResource($guest),
            null
        );
    }

    public function guestServicesAssign(Request $request) {
        if (gettype($request->services) === 'array') {
            if (count($request->services) > 0) {
                foreach($request->services as $val) {
                    $service = GuestService::create([
                        "guest_fk" => $request->guest_fk,
                        "service_fk" => $val,
                        'inserted_by' => $request->token->id,
                        'updated_by' => $request->token->id
                    ]);
                }
                return ResponseHandler::successResponse(
                    'Service successfully assigned to guest',
                    Response::HTTP_OK,
                    $service,
                    null
                );
            } else {
                return ResponseHandler::errorResponse(
                    'No assign records found',
                    Response::HTTP_NO_CONTENT
                );
            }
        }
        return ResponseHandler::errorResponse(
            'Request services must be an array',
            Response::HTTP_BAD_REQUEST
        );
    }

    public function updateGuestAssignedServices(Request $request, $guest_fk) {
        $guest = GuestService::where('guest_fk', $guest_fk)->firstOrFail();
        if (count($request->data) > 0) {
            foreach($request->data[1] as $val) {
                foreach ($request->data[0] as $val1) {
                        
                        $guest->where('service_fk', $val1)
                            ->delete();
                                                       
                        $guest1 = GuestService::where('guest_fk', $guest_fk)
                            ->where('service_fk', $val)->first();
                            if (!$guest1) {
                                GuestService::create([
                                    "guest_fk" => $guest_fk,
                                    "service_fk" => $val,
                                    'inserted_by' => $request->token->id,
                                    'updated_by' => $request->token->id
                                ]);
                            }
                        }
                }
                
                return ResponseHandler::successResponse(
                    'A guest services updated successfullyfdsa',
                    Response::HTTP_OK,
                    $guest,
                    null
                );
        
    } else {        
        return ResponseHandler::errorResponse(
            'Requests are empty',
            Response::HTTP_NO_CONTENT
        );
    }
}

public function deleteGuestAssignedServices(Request $request, $guest_fk) {
    $guest = Guest::where('id', $guest_fk)
    ->where('guest_house_fk', $request->token->guest_house_fk)->first();
    if (count($guest->services) > 0) {
    foreach ($guest->services as $service) {
        GuestService::where('guest_fk', $service['pivot']['guest_fk'])->delete();
    }
    }
    return ResponseHandler::successResponse(
        'All guest services deleted successfully',
        Response::HTTP_OK,
        null,
        null
    );
}

    public function getGuests(Request $request) {
        $guests = Guest::where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All guests returned successfully',
            Response::HTTP_OK,
            GuestResource::collection($guests),
            null
        );
    }

    public function getActiveGuests(Request $request) {
        $guests = guest::where('status', 'active')
        ->where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All guests returned successfully',
            Response::HTTP_OK,
            GuestResource::collection($guests),
            null
        );
    }

    public function getInactiveGuests(Request $request) {
        $guests = guest::where('status', 'inactive')
        ->where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All guests returned successfully',
            Response::HTTP_OK,
            GuestResource::collection($guests),
            null
        );
    }

    public function editGuest(Request $request, $first_name) {
        $guest = guest::where('first_name', $first_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        return ResponseHandler::successResponse(
            'a guest returned successfully',
            Response::HTTP_OK,
            $guest,
            null
        );
    }

    public function updateGuest(GuestRequest $request, $first_name) {
        $guest = guest::where('first_name', $first_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $guest_house = GuestHouse::where('id', $guest->guest_house_fk)->first();
        foreach($guest_house->guests as $gst) {
            if (($gst->id_number === $request->id_number || $gst->phone_number === $request->phone_number)
            && ($gst->id_number !== $request->id_number || $gst->phone_number !== $request->phone_number)) {
                return ResponseHandler::errorResponse(
                    'A guest with those credentials exist',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
        $guest->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'arrival_time' => $request->arrival_date." ".$request->arrival_time,
        'departure_time' => $request->departure_date." ".$request->departure_time,
        'room_fk' => $request->room_fk,
        'status' => $request->room_fk ? 'active' : 'inactive',
        'nationality' => $request->nationality,
        'id_type' => $request->id_type,
        'id_number' => $request->id_number,
        'extra_note' => $request->extra_note,
        'updated_by' => $request->token->id
        ]);
        DB::table('rooms')
              ->where('id', $guest->room_fk)
              ->update($guest->status === 'inactive' ?
              ['status' => 'inactive'] : ['status' => 'active']);
        return ResponseHandler::successResponse(
            'a guest updated successfully',
            Response::HTTP_OK,
            new GuestResource($guest),
            null
        );
    }

    public function updateGuestStatus(guestStatusRequest $request, $first_name) {
        $guest = guest::where('first_name', $first_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $status = $guest->status;
        $guest->update([
            'status' => $request->status,
            'updated_by' => $request->token->id
        ]);
            if ($request->status === $status) {
                    return ResponseHandler::successResponse(
                        'Guest status updated successfully, but is already assigned to that status', 
                        Response::HTTP_OK,
                        null,
                        null
                    );
            }
            DB::table('rooms')
              ->where('id', $guest->room_fk)
              ->update($guest->status === 'inactive' ?
              ['status' => 'inactive'] : ['status' => 'active']);
        return ResponseHandler::successResponse(
            'A guest status updated successfully',
            Response::HTTP_OK,
            new GuestResource($guest),
            null
        );
    }

    public function deleteGuest(Request $request, $first_name) {
        $guest = guest::where('first_name', $first_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $guest->delete();
        return ResponseHandler::successResponse(
            'A guest deleted successfully',
            Response::HTTP_OK,
            null,
            null
        );
    }
}
