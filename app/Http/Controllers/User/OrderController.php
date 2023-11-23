<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelectPaymentMethodRequest;
use App\Http\Requests\StoreParticipantRequest;
use App\Mail\Admin\NewTransaction;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\TrainingService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        // foreach (TransactionService::transactionIndex() as $transaction) {
        //     dump($transaction->orders);
        // }
        return view('user.pages.order.index')
            ->with([
                'transactions' => TransactionService::transactionIndex(Auth::id())
            ]);
    }

    public function orderTraining($id, Request $request)
    {
        $request = $request->validate(
            ['q' => 'numeric']
        );

        if ($request['q'] < 1) {
            return redirect()->to(route('user.training_detail', $id))->with('error', 'Jumlah peserta yang anda masukkan tidak valid.');
        }

        // dd($request);

        $participants = $request['q'];
        $training = TrainingService::getTrainingById($id)->fetch();
        $price = TrainingService::getTrainingById($id)->trainingPrice();
        $totalPrice = $price * $request['q'];

        if ($training->quotaPerOrg->quota != null) {
            $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
            if ($participants > $leftoverQuota) {
                return redirect()->to(route('user.training_detail', $id))->with('error', 'Peserta melebihi jumlah kuota yang ditentukan.');
            }
        }

        return view('user.pages.training.fill_order')
            ->with([
                'participants' => $participants,
                'training' => $training,
                'price' => $price,
                'totalPrice' => $totalPrice,
                'paymentMethod' => PaymentMethodEnum::cases()
            ]);
    }

    public function fillOrder(StoreParticipantRequest $request)
    {
        $userId = Auth::id();

        // $order = OrderService::createOrder(Arr::add($request->validated(), 'total_price', $request->total_price), $userId);

        CartService::addToCart($userId, $request);


        return redirect()->route('user.cart_index');
    }

    public function createOrder(SelectPaymentMethodRequest $request)
    {
        $userId = Auth::id();

        $validated = $request->validated();

        $items = CartService::cartItems($userId);

        // dd($items);

        $order = OrderService::createOrder($items, $userId, $validated);

        Mail::to(Env::get('MAIL_USERNAME'))->send(new NewTransaction($order));

        return redirect()->to(route('user.detail_order', $order));
    }

    public function show($id)
    {
        if (Auth::id() != Transaction::findOrFail($id)->user_id) {
            abort(403);
        }

        $transaction = TransactionService::transactionDetail($id);
        // dd($transaction);

        // dd($transaction);

        // foreach ($transaction->orders as $order) {
        //     // foreach ($order->orderparticipants as $participant) {
        //     //     dump($participant->student->name);
        //     // }
        //     dump($order->training->cost);
        // }

        // die();

        if ($transaction->payment_amount > 0) {
            if ($transaction->payment_method == 'Transfer') {
                // dump($transaction);
                return view('user.pages.order.detail')
                    ->with([
                        'data' => $transaction
                    ]);
            }

            if ($transaction->payment_method == 'Midtrans') {
                // dump($transaction);

                return view('user.pages.order.detail-midtrans')
                    ->with([
                        'data' => $transaction,
                        // 'midtransClientKey' => "SB-Mid-client-NUHDTW6uipcvE7sz"
                    ]);
            }
        }

        // dump($transaction);

        // die();

        return view('user.pages.order.detail-free')
            ->with([
                'data' => $transaction,
                // 'midtransClientKey' => "SB-Mid-client-NUHDTW6uipcvE7sz"
            ]);
    }

    public function downloadInvoice($id)
    {
        $transaction = TransactionService::transactionDetail($id);


        if ($transaction->payment_amount > 0 && $transaction->payment_date == null) {
            abort(403);
        }

        // dd($transaction);
        // return view('user.pages.order.invoice')
        //     ->with([
        //         'data' => $transaction
        //     ]);

        $data = $transaction;
        $pdf = PDF::loadView('user.pages.order.invoice', compact('data'));

        return $pdf->download("invoice-{$transaction->id}.pdf");
    }
}
