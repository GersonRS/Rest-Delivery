<?php

namespace Delivery\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CompanyResource extends Resource
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
            'id'            =>  (int) $this->id,
            'name'          =>  $this->name,
            'name_label'    =>  $this->name_label,
            'lat'           =>  $this->lat,
            'lng'           =>  $this->lng,
            'website'       =>  $this->website,
            'mail'          =>  $this->mail,
            'address'       =>  $this->address,
            'active'        =>  $this->active,
            'image'         =>  $this->image
        ];
    }
}
