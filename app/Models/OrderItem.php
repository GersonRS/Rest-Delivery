<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
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
