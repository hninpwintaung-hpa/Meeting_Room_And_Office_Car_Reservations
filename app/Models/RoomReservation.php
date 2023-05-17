<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomReservation extends Pivot
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'date', 'user_id', 'room_id',];
}
