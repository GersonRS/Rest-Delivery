<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Company;

/**
 * Class CompanyTransformer
 * @package namespace Delivery\Transformers;
 */
class CompanyTransformer extends TransformerAbstract
{

    protected $availableIncludes = [ 'category', 'order', 'user','cupom'];

    /**
     * Transform the \Company entity
     * @param \Company $model
     *
     * @return array
     */
    public function transform(Company $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'lat' => $model->lat,
            'lng' => $model->lng,
            'website' => $model->website,
            'mail' => $model->mail,
            'address' => $model->address,
            'image' => $model->image
        ];
    }

    public function includeCategory(Company $model)
    {
        return $this->collection($model->category, new CategoryTransformer());
    }

    public function includeOrder(Company $model)
    {
        return $this->collection($model->order, new OrderTransformer());
    }

    public function includeUser(Company $model)
    {
        return $this->item($model->user, new UserTransformer());
    }

    public function includeCupom(Company $model)
    {
        return $this->collection($model->cupom, new CupomTransformer());
    }
}
