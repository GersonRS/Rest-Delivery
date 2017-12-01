<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Artesaos\Defender\Traits\Models\Role as RoleTrait;
use Artesaos\Defender\Contracts\Role as RoleInterface;

class Role extends Model implements Transformable, RoleInterface
{
    use TransformableTrait, RoleTrait;


}
