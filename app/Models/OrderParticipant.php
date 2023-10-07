<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderParticipant extends Model
{
    use HasFactory;

    protected $table = 'order_participant';

    protected $fillable = [
        'user_id',
        'order_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
