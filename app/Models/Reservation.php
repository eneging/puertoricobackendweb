<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
     protected $fillable = [
        'user_id', 'reservable_item_id', 'reservation_date',
        'start_time', 'end_time', 'number_of_people',
        'total_price', 'status', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservableItem()
    {
        return $this->belongsTo(ReservableItem::class);
    }
}