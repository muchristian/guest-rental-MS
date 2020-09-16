<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestHouseGetOneResource extends JsonResource
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
            'slogan' => $this->slogan,
            'logo' => $this->logo,
            'location' => $this->location,
            'status' => $this->status,
            'user' => $this->users,
            'create_at' => $this->created_at
        ];
    }
}
