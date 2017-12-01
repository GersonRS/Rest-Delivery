<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Category;

/**
 * Class CategoryTransformer
 * @package namespace Delivery\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ["product"];

    /**
     * Transform the \Category entity
     * @param \Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'image'      => $model->image
        ];
    }

    public function includeProduct(Category $model)
    {
        return $this->collection($model->products, new ProductTransformer());
    }
}
