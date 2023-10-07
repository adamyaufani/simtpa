<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'director',
        'vice_director',
        'secretary',
        'treasurer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function director()
    {
        return $this->join('staffs', 'administrators.director', '=', 'staffs.id')
            ->where('staffs.user_id', '=', Auth::user()->id);
    }

    public function viceDirector()
    {
        return $this->join('staffs', 'administrators.vice_director', '=', 'staffs.id')
            ->where('staffs.user_id', '=', Auth::user()->id);
    }

    public function secretary()
    {
        return $this->join('staffs', 'administrators.secretary', '=', 'staffs.id')
            ->where('staffs.user_id', '=', Auth::user()->id);
    }

    public function treasurer()
    {
        return $this->join('staffs', 'administrators.treasurer', '=', 'staffs.id')
            ->where('staffs.user_id', '=', Auth::user()->id);
    }
}
