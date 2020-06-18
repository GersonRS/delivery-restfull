<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplementResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'min' => $this->min,
            'max' => $this->max,
            'mandatory' => $this->mandatory,
            'order' => $this->order,
            'active' => $this->active,
            'product' => ProductResource::make($this->whenLoaded('product')),
            'items' => ItemResource::collection($this->whenLoaded('items'))
        ];
    }
}
