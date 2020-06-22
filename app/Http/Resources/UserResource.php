<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'fullName' => $this->firstName." ".$this->lastName,
            'username' => $this->username,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'guestHouse' => $this->guest_houses->name,
            'role' => $this->role,
            'gender' => $this->gender,
            'created_at' => $this->created_at
        ];
    }
}
