<?php

namespace App\Http\Controllers;

use App\GuestHouse;
use App\Service;
use App\GuestService;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceGetOneResource;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\ResponseHandler;
use DB;

class ServiceController extends Controller
{
    public function createService(ServiceRequest $request) {
        $guest_house =GuestHouse::where('id', $request->token->guest_house_fk)->first();
        foreach($guest_house->services as $service) {
            if ($service->service_name === $request->service_name) {
                return ResponseHandler::errorResponse(
                    'a service with that name exist',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
        $service = Service::create([
            'service_name' => $request->service_name,
            'service_price' => $request->service_price,
            'remarks' => $request->remarks,
            'guest_house_fk' => $request->token->guest_house_fk,
            'inserted_by' => $request->token->id,
            'updated_by' => $request->token->id
        ]);
        return ResponseHandler::successResponse(
            'You successfully created a service',
            Response::HTTP_OK,
            new ServiceResource($service),
            null
        );
    }

    public function getOneService(Request $request, $service_name) {
        $service = Service::where('service_name', $service_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail(); 
        return ResponseHandler::successResponse(
            'a service returned successfully',
            Response::HTTP_OK,
            new ServiceGetOneResource($service),
            null
        );
    }

    public function getServices(Request $request) {
        $service = Service::where('guest_house_fk', $request->token->guest_house_fk)->get();
        return ResponseHandler::successResponse(
            'All services returned successfully',
            Response::HTTP_OK,
            ServiceResource::collection($service),
            null
        );
    }

    public function editService(Request $request, $service_name) {
        $service = Service::where('service_name', $service_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        return ResponseHandler::successResponse(
            'a service returned successfully',
            Response::HTTP_OK,
            $service,
            null
        );
    }

    public function updateService(ServiceRequest $request, $service_name) {
        $service = Service::where('service_name', $service_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $guest_house =GuestHouse::where('id', $service->guest_house_fk)->first();
        foreach($guest_house->services as $sv) {
            if ($sv->service_name === $request->service_name && $service->service_name !== $request->service_name) {
                return ResponseHandler::errorResponse(
                    'a service with that name exist',
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
        $service->update([
            'service_name' => $request->service_name,
            'service_price' => $request->service_price,
            'remarks' => $request->remarks,
            'updated_by' => $request->token->id
        ]);
        return ResponseHandler::successResponse(
            'a service updated successfully',
            Response::HTTP_OK,
            new ServiceResource($service),
            null
        );
    }

    public function deleteService(Request $request, $service_name) {
        $service = Service::where('service_name', $service_name)
        ->where('guest_house_fk', $request->token->guest_house_fk)->firstOrFail();
        $service->delete();
        return ResponseHandler::successResponse(
            'a Service deleted successfully',
            Response::HTTP_OK,
            null,
            null
        );
    }
}
