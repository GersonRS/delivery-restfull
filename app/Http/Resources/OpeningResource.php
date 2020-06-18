<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpeningResource extends JsonResource
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
            'weekday' => $this->weekday,
            'start' => $this->start,
            'end' => $this->end,
            'establishment' => EstablishmentResource::make($this->whenLoaded('establishment')),
        ];
    }
}
