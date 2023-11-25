<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_participant_id',
        'status'
    ];

    public function orderParticipant()
    {
        return $this->belongsTo(OrderParticipant::class);
    }
}
