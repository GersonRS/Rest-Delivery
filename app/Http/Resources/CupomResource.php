<?php

namespace Delivery\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CupomResource extends Resource
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
            'code'       => (int) $this->code,
            'value'      => (float) $this->value,
            'type'    => $this->type
        ];
    }
}
