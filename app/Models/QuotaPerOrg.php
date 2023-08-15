<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotaPerOrg extends Model
{
    use HasFactory;

    protected $fillable = [
        'quota',
        'training_id'
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
