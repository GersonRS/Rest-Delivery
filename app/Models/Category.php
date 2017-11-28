<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
