<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionService
{

    public static function transactionIndex($userId = null)
    {
        if (isset(Auth::user()->role_id) == 2) {
            return Transaction::with(['orders.orderparticipants', 'orders.training', 'orders.orderparticipants.student', 'user.userProfile'])
                ->when($userId, fn ($query) => $query->where('user_id', $userId))
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();
        }
        return Transaction::with(['orders.orderparticipants', 'orders.training', 'orders.orderparticipants.student', 'user.userProfile'])
            ->when($userId, fn ($query) => $query->where('user_id', $userId))
            ->orderBy('created_at', 'desc')
            ->get();
        // ->paginate(10)
        // ->withQueryString();
    }

    public static function transactionDetail($id)
    {
        return Transaction::with(['user', 'orders.orderparticipants', 'orders.training', 'orders.orderparticipants.student', 'orders.orderparticipants.staff'])
            ->findOrFail($id);
    }
}
