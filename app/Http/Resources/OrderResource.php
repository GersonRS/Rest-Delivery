<?php

namespace Delivery\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Collection;

class OrderResource extends Resource
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
            'total'         => (float) $this->total,
            'comment'       => $this->comment,
            'status'        => $this->status,
            'statusName'         => $this->getStatusName($this->status),
            'product_names' => $this->getArrayProductsNames($this->items),
            'hash' => $this->hash,
            'created_at' => $this->created_at,
            'items'=> OrderItemResource::collection($this->items),
            'company'=> new CompanyResource($this->company),
            'cupom'=> new CupomResource($this->cupom)
        ];
    }

    protected function getArrayProductsNames(Collection $items)
    {
        $names = [];
        foreach($items as $item){
            $names[] = $item->product->name;
        }
        return $names;
    }
    protected function getStatusName($idStatus)
    {
        $statusName = "";
        switch($idStatus){
            case 0: {
                $statusName = "em Processo";
                break;
            }
            case 1: {
                $statusName = "Confirmado";
                break;
            }
            case 2: {
                $statusName = "indo para Entrega";
                break;
            }
            case 3: {
                $statusName = "Entregue";
                break;
            }
            case 4: {
                $statusName = "Cancelado";
                break;
            }
        }
        return $statusName;
    }
}
