<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_number',
        'subject',
        'attachment',
        'content'
    ];

    protected $casts = [
        'created_at' => 'date',
    ];

    public function userLetterStatuses()
    {
        return $this->hasMany(UserLetterStatus::class);
    }
}
