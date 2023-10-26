<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // dd(TransactionService::transactionIndex());
        // foreach (TransactionService::transactionIndex() as $transaction) {
        //     foreach ($transaction->orders as $order) {
        //         dump($order->orderparticipants->count());
        //     }
        // }
        // die();

        return view('admin.pages.order.index')
            ->with(['transactions' => TransactionService::transactionIndex()]);
    }

    public function show($id)
    {
        // dd(TransactionService::transactionDetail($id));
        return view('admin.pages.order.detail')
            ->with([
                'data' => TransactionService::transactionDetail($id)
            ]);
    }

    public function confirmPayment($id)
    {
        OrderService::confirmOrderPayment($id);
        return redirect()->back();
    }
}
