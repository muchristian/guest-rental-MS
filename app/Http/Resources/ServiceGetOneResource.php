<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceGetOneResource extends JsonResource
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
            'service_name' => $this->service_name,
            'service_price' => $this->service_price,
            'remarks' => $this->remarks,
            'inserted_by' => $this->inserties_by,
            'updated_by' => $this->updaties_by
        ];
    }
}
