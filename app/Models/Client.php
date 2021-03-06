<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'zipcode',
        'complement'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
