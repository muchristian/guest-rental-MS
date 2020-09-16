<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestHouseResource extends JsonResource
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
            'name' => $this->name,
            'location' => $this->location,
            'status' => $this->status,
            'user' => $this->users,
            'rooms' => $this->rooms,
            'guests' => $this->guests,
            'services' => $this->services,
            'create_at' => $this->created_at
        ];
    }
}
