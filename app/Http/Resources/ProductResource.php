<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'active' => $this->active,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'promotion' => PromotionResource::make($this->whenLoaded('promotion')),
            'complements' => ComplementResource::collection($this->whenLoaded('complements')),
            'availabilities' => AvailabilityResource::collection($this->whenLoaded('availabilities')),
            'order' => $this->whenPivotLoaded('order_product', function () {
                return [
                    'amount' => $this->pivot->amount,
                    'price' => $this->pivot->price
                ];
            })
        ];
    }
}
