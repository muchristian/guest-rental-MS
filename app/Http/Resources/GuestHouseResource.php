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
            'name' => $this->name,
            'slogan' => $this->slogan,
            'location' => $this->location,
            'logo' => $this->logo,
            'admin' => $this->users[0]->firstName." ".$this->users[0]->lastName
        ];
    }
}
