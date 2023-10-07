<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'fullname',
        // 'phone',
        // 'agency',
        // 'username',
        'role_id',
        'email',
        'password',
        'institution_name',
        'verification_status',
        'verification_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function administrators()
    {
        return $this->hasMany(Administrator::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }

    protected function scopeWaitingVerification($query)
    {
        $query->where('verification_status', '=', 0);
    }

    protected function scopeVerified($query)
    {
        $query->where('verification_status', '=', 1);
    }

    protected function scopeVerificationDenied($query)
    {
        $query->where('verification_status', '=', 2);
    }

    protected function getStatusAttribute()
    {
        if ($this->verification_status == 0) {
            return [
                'badge' => 'warning',
                'message' => 'menunggu verifikasi'
            ];
        }
        if ($this->verification_status == 1) {
            return [
                'badge' => 'success',
                'message' => 'pengguna terverifikasi'
            ];
        }
        if ($this->verification_status == 2) {
            return [
                'badge' => 'danger',
                'message' => 'dibekukan'
            ];
        }
    }
}
