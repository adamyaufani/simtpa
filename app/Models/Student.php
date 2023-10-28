<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'father_name',
        'mother_name',
        'phone',
        'school',
        'join_date',
        'status',
        'ability_level_upon_entry',
        'birth_certificate',
    ];

    protected $casts = [
        // 'join_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function birthCertificate(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value !== null ? Crypt::encryptString($value) : $value;
            }
        );
    }
}
