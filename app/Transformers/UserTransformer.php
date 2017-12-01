<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\User;

/**
 * Class UserTransformer
 * @package namespace Delivery\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['client'];
    protected $defaultIncludes = ["role"];
    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'email'      => $model->email
        ];
    }

    public function includeClient(User $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeRole(User $model)
    {
        return $this->collection($model->roles, new RoleTransformer());
    }
}
