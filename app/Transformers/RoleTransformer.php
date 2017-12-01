<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Role;

/**
 * Class RoleTransformer
 * @package namespace Delivery\Transformers;
 */
class RoleTransformer extends TransformerAbstract
{

    /**
     * Transform the \Role entity
     * @param \Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id'        => (int) $model->id,
            'name'      => $model->name
        ];
    }
}
