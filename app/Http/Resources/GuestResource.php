<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'full_name' => $this->first_name." ".$this->last_name,
        'phone_number' => $this->phone_number,
        'arrival_time' => $this->arrival_time,
        'departure_time' => $this->departure_time,
        'room_fk' => $this->rooms,
        'service_fk' => $this->services,
        'status' => $this->status,
        'inserted_by' => $this->inserties_by,
        'updated_by' => $this->updaties_by
        ];
    }
}
