<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservableItem extends Model
{
      protected $fillable = [
        'service_type_id', 'name', 'description', 'hourly_rate', 'capacity', 'is_available'
    ];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}