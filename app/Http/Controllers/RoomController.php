<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\RoomStatusRequest;
use App\Http\Resources\RoomResource;
use App\Http\Resources\RoomGetOneResource;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use App\GuestHouse;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function createRoom(RoomRequest $request) {
        $guest_house =GuestHouse::where('id', $request->token->guest_house_fk)->first();
        foreach($guest_house->rooms as $room) {
            if ($room->room_name === $request->room_name) {
                return ResponseHandler::errorResponse(
                    'a room with that name exist',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
        $room = Room::create([
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'comment' => $request->comment,
            'guest_house_fk' => $request->token->guest_house_fk,
            'inserted_by' => $request->token->id,
            'updated_by' => $request->token->id
        ]);
        return ResponseHandler::successResponse(
            'You successfully created a room',
            Response::HTTP_OK,
            new RoomResource($room),
            null
        );
    }

    public function getOneRoom(Request $request, $room_name) {
        $room = Room::where('room_name', $room_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail(); 
        return ResponseHandler::successResponse(
            'a room returned successfully',
            Response::HTTP_OK,
            new RoomGetOneResource($room),
            null
        );
    }

    public function getRooms(Request $request) {
        $room = Room::where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All rooms returned successfully',
            Response::HTTP_OK,
            RoomResource::collection($room),
            null
        );
    }

    public function getActiveRooms(Request $request) {
        $room = Room::where('status', 'active')
        ->where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All rooms returned successfully',
            Response::HTTP_OK,
            RoomResource::collection($room),
            null
        );
    }

    public function getInactiveRooms(Request $request) {
        $room = Room::where('status', 'inactive')
        ->where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All rooms returned successfully',
            Response::HTTP_OK,
            RoomResource::collection($room),
            null
        );
    }

    public function editRoom(Request $request, $room_name) {
        $room = Room::where('room_name', $room_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        return ResponseHandler::successResponse(
            'a room returned successfully',
            Response::HTTP_OK,
            $room,
            null
        );
    }

    public function updateRoom(RoomRequest $request, $room_name) {
        $room = Room::where('room_name', $room_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $guest_house =GuestHouse::where('id', $room->guest_house_fk)->first();
        foreach($guest_house->rooms as $rm) {
            if ($rm->room_name === $request->room_name && $room->room_name !== $request->room_name) {
                return ResponseHandler::errorResponse(
                    'a room with that name exist',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
        $room->update([
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'comment' => $request->comment,
            'status' => $request->status,
            'updated_by' => $request->token->id
        ]);
        return ResponseHandler::successResponse(
            'a room updated successfully',
            Response::HTTP_OK,
            new RoomResource($room),
            null
        );
    }

    public function updateRoomStatus(RoomStatusRequest $request, $room_name) {
        $room = Room::where('room_name', $room_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $status = $room->status;
        $room->update([
            'status' => $request->status,
            'updated_by' => $request->token->id
        ]);
            if ($request->status === $status) {
                    return ResponseHandler::successResponse(
                        'Room status updated successfully, but is already assigned to that status', 
                        Response::HTTP_OK,
                        null,
                        null
                    );
            }
        return ResponseHandler::successResponse(
            'A room status updated successfully',
            Response::HTTP_OK,
            new RoomResource($room),
            null
        );
    }

    public function deleteRoom(Request $request, $room_name) {
        $room = Room::where('room_name', $room_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $room->delete();
        return ResponseHandler::successResponse(
            'a room deleted successfully',
            Response::HTTP_OK,
            null,
            null
        );
    }
}
