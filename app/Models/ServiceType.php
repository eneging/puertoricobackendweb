<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    
 
      protected $fillable = [
        'name', 'description', 'base_price_per_hour', 'max_capacity'
    ];

    public function reservableItems()
    {
        return $this->hasMany(ReservableItem::class);
    }
}