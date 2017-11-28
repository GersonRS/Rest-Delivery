<?php

namespace Delivery\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ClientResource extends Resource
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
            'id'         => (int) $this->id,
            'phone'      => $this->phone,
            'address'    => $this->address,
            'city'       => $this->city,
            'state'      => $this->state,
            'zipcode'    => $this->zipcode
        ];
    }
}
