<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OrderItem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'amount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);

    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
