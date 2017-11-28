<?php

namespace Delivery\Http\Resources;

use Delivery\Models\Product;
use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
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
            'id'            => (int) $this->id,
            'name'          =>  $this->name,
            'description'   =>  $this->description,
            'image'         =>  $this->image,
            'products'      =>  ProductResource::collection($this->products)
        ];
    }
}
