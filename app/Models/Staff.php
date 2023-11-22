<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'employment_status',
        'civil_registration_number',
        'last_formal_education',
        'length_of_islamic_education',
        'core_competency',
        'phone',
        'email',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value !== null ? Crypt::encryptString($value) : $value;
            }
        );
    }
}
