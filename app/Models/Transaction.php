<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'transaction_date',
        'payment_date',
        'payment_amount',
        'status',
        'transaction_id'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTransactionStatusAttribute()
    {
        if ($this->status_order == "Lunas") {
            return "Lunas";
        }

        if (Carbon::now()->gt(Training::find($this->orders()->first()->training_id)->start_date)) {
            return "Expired";
        }

        return "Pending";
    }
}
