<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'total' => $this->total,
            'comment' => $this->comment,
            'pay' => $this->pay,
            'status' => $this->status,
            'hash' => $this->hash,
            'address' => AddressResource::make($this->whenLoaded('address')),
            'establishment' => EstablishmentResource::make($this->whenLoaded('establishment')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'order' => $this->whenPivotLoaded('order_product', function () {
                return [
                    'amount' => $this->pivot->amount,
                    'price' => $this->pivot->price
                ];
            })

        ];
    }
}
