<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'staff_id',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function eventAttendance()
    {
        return $this->hasOne(EventAttendance::class);
    }
}
