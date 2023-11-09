<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLetterStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'letter_id',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}
