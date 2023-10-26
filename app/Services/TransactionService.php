<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{

    public static function transactionIndex()
    {
        return Transaction::with(['orders.orderparticipants', 'orders.training', 'orders.orderparticipants.student'])
            ->paginate(10)
            ->withQueryString();
    }

    public static function transactionDetail($id)
    {
        return Transaction::with(['orders.orderparticipants', 'orders.training', 'orders.orderparticipants.student'])
            ->findOrFail($id);
    }
}
