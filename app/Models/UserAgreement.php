<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agreement_id',
        'sign',
    ];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }
}
