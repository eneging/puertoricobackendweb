<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'order_number',
    'customer_name',
    'customer_phone',
    'location_url',
    'total',
];

public function items()
{
    return $this->hasMany(OrderItem::class);
}

}