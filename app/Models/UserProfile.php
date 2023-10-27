<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institution_name',
        'nspq_number',
        'supervisory_institution_name',
        'years_of_establishment',
        'address',
        'village',
        'postal_code',
        'phone_number',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'tiktok',
        'website',
        'gmap_address',
        'sk_number',
        'sk_number_starting_date',
        'sk_number_ending_date',
        'sk_file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function villageDetail()
    {
        return $this->belongsTo(Village::class, 'village');
    }

    protected function skFile(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value !== null ? Crypt::encryptString($value) : $value;
            }
        );
    }
}
