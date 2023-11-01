<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_start',
        'year_end',
        'content',
    ];

    public function userAgreement()
    {
        return $this->hasMany(UserAgreement::class);
    }
}
