<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomGetOneResource extends JsonResource
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
            'room_name' => $this->room_name,
            'room_type' => $this->room_type,
            'status' => $this->status,
            'comment' =>$this->comment,
            'inserted_by' => $this->inserties_by,
            'updated_by' => $this->updaties_by
        ];
    }
}
