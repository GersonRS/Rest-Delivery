<?php

namespace Delivery\Transformers;

use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;
use Delivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{

    protected $availableIncludes = [ 'client', 'cupom', 'items', 'company'];
    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'total'         => (float) $model->total,
            'comment'       => $model->comment,
            'status'        => $model->status,
            'pay'           => $model->pay,
            'statusName'         => $this->getStatusName($model->status),
            'product_names' => $this->getArrayProductsNames($model->items),
            'hash' => $model->hash,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
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
    public function includeCompany(Order $model)
    {
        return $this->item($model->company, new CompanyTransformer());
    }
    public function includeClient(Order $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }
    public function includeCupom(Order $model)
    {
        if(!$model->cupom){
            return null;
        }
        return $this->item($model->cupom, new CupomTransformer());
    }
    public function includeItems(Order $model)
    {
        return $this->collection($model->items, new OrderItemTransformer());
    }
}
