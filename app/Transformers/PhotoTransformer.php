<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Photo;

/**
 * Class PhotoTransformer
 * @package namespace Delivery\Transformers;
 */
class PhotoTransformer extends TransformerAbstract
{

    /**
     * Transform the Photo entity
     * @param Delivery\Models\Photo $model
     *
     * @return array
     */
    public function transform(Photo $model)
    {
        return [
            'id'         => (int) $model->id,
            'url'        => $model->url
        ];
    }
}
