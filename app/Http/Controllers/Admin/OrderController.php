<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Services\OrderService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        // dd(TransactionService::transactionIndex());

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
        $order = OrderService::confirmOrderPayment($id);
        $user = User::find($order->user_id);
        Mail::to($user->email)->send(new \App\Mail\User\PaymentConfirmed($user->id, $order->id));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus');
    }
}
