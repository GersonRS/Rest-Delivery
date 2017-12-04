<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'name',
        'nameLable',
        'lat',
        'lng',
        'website',
        'mail',
        'address',
        'phone',
        'image',
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::Class);

    }

    public function category()
    {
        return $this->hasMany(Category::Class);
    }

    public function cupom()
    {
        return $this->hasMany(Cupom::Class);
    }

}
