<?php

namespace Delivery\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrderItemResource extends Resource
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
            'id'        => (int) $this->id,
            'price'     => (float) $this->price,
            'amount'    => (int) $this->amount,
            'product'  => new ProductResource($this->product)
        ];
    }
}
