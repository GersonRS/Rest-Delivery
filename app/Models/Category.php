<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'company_id',
        'description',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::Class);

    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}
