<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nameLable',
        'lat',
        'lng',
        'website',
        'mail',
        'address',
        'image'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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
