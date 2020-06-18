<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'image' => $this->image,
            'address' => AddressResource::collection($this->whenLoaded('address')),
            'establishment' => EstablishmentResource::make($this->whenLoaded('establishment')),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
