<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\TrainingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderTraining($id, Request $request)
    {
        $request = $request->validate(
            ['q' => 'numeric']
        );

        $participants = $request['q'];
        $training = TrainingService::getTrainingById($id)->fetch();
        $price = TrainingService::getTrainingById($id)->trainingPrice();
        $totalPrice = $price * $request['q'];

        if ($training->quotaPerOrg->quota != null) {
            $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
            if ($participants > $leftoverQuota) {
                return redirect()->to(route('user.training_detail', $id))->with('error', 'Peserta yang anda daftarkan melebihi jumlah kuota anda.');
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
        $order = OrderService::createOrder($request->validated(), Auth::id());

        return redirect()->route('user.detail_order', $order);
    }

    public function show($id)
    {
        if (Auth::id() != Order::findOrFail($id)->user_id) {
            abort(403);
        }

        $order = OrderService::detailOrder($id)->fetch();

        // dd($order);

        if ($order['training']->cost == 'paid') {
            if ($order['order']['payment_method']->value == 'Transfer') {
                return view('user.pages.order.detail')
                    ->with([
                        'data' => $order
                    ]);
            }

            if ($order['order']['payment_method']->value == 'Midtrans') {
                return view('user.pages.order.detail-midtrans')
                    ->with([
                        'data' => $order,
                        // 'midtransClientKey' => "SB-Mid-client-NUHDTW6uipcvE7sz"
                    ]);
            }
        }

        return view('user.pages.order.detail-free')
            ->with([
                'data' => $order,
                // 'midtransClientKey' => "SB-Mid-client-NUHDTW6uipcvE7sz"
            ]);
    }
}
