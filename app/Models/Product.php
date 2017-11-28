<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::Class, 'category_id', 'id');
    }
}
