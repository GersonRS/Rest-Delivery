<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'company_id',
        'cupom_id',
        'total',
        'comment',
        'pay',
        'status',
        'hash'
    ];

    public function cupom()
    {
        return $this->belongsTo(Cupom::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
