<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Artesaos\Defender\Traits\Models\Permission as PermissionTrait;
use Artesaos\Defender\Contracts\Permission as PermissionInterface;

class Permission extends Model implements Transformable, PermissionInterface
{
    use TransformableTrait, PermissionTrait;
}
