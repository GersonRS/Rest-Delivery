<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Permission;

/**
 * Class PermissionTransformer
 * @package namespace Delivery\Transformers;
 */
class PermissionTransformer extends TransformerAbstract
{

    /**
     * Transform the Permission entity
     * @param Delivery\Models\Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
