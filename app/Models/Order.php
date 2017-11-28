<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'cupom_id',
        'total',
        'comment',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}
