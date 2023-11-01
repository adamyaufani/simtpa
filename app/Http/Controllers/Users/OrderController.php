<?php

namespace App\Http\Controllers\Users;

use App\Enums\PaymentMethodEnum;
use App\Http\Requests\StoreParticipantRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Services\TrainingService;
use Error;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Throwable;

class OrderController extends Controller
{
    public function createOrder(CreateOrderRequest $request)
    {
        $participant = $request['qty'];
        $id = $request['training_id'];
        $training = TrainingService::getTrainingById($id)->fetch();

        if ($training->quotaPerOrg->quota != null) {
            $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
            if ($participant > $leftoverQuota) {
                return redirect()->to(route('user.training_detail', $id))->with('error', 'Peserta yang anda daftarkan melebihi jumlah kuota anda.');
            }
        }

        // $orderId = OrderService::createOrder($request, Auth::id());

        // return redirect()->to(route('user.complete_order', $orderId));
    }

    public function completeOrder($id)
    {
        $order = OrderService::detailOrder($id)->fetch();
        // dd($order['order']->id);
        $participants = $order['participants'];
        $numberOfParticipants = $order['numberOfParticipants'];
        $training = $order['training'];
        $price = $order['trainingPrice'];
        $totalPrice = $order['totalPrice'];

        return view('user.pages.training.checkout')
            ->with([
                'orderId' => $order['order']->id,
                'participants' => $participants,
                'numberOfParticipants' => $numberOfParticipants,
                'training' => $training,
                'price' => $price,
                'totalPrice' => $totalPrice,
                'paymentMethod' => PaymentMethodEnum::cases()
            ]);
    }

    public function storeCompletedOrder(StoreParticipantRequest $request)
    {
        OrderService::completeOrder($request->validated(), Auth::id());

        return redirect()->to(route('user.select_order_payment', $request->validated()['order_id']));
    }

    public function selectPayment($id)
    {
        return view('user.pages.order.select-payment')
            ->with([
                'order' => Order::findOrFail($id),
                'paymentMethods' => PaymentMethodEnum::cases()
            ]);
    }

    public function checkout(Request $request)
    {
        if ($request->payment_method == 'Midtrans') {
            dd('midtrans');
        }

        if ($request->payment_method == 'Transfer') {
            dd('transfer');
        }
    }

    public function index()
    {
        return view('user.pages.order.index')
            ->with([
                'orders' => OrderService::orderIndex(Auth::id())
            ]);
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

    public function placeOrder(StoreParticipantRequest $request)
    {
        // $orderId = OrderService::createOrder($request->validated(), Auth::id());
        // return redirect()->to(route('user.detail_order', $orderId));
    }

    public function midtransCheckoutProcess($id)
    {
        $params = OrderService::detailOrder($id)->checkoutData();
        try {
            $paymentUrl = Snap::createTransaction($params)->redirect_url;
            return redirect()->to($paymentUrl);
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Tidak bisa melakukan pembayaran.');
        }
    }

    function printExampleWarningMessage()
    {
        if (strpos(Config::$serverKey, 'your ') != false) {
            echo "<code>";
            echo "<h4>Please set your server key from sandbox</h4>";
            echo "In file: " . __FILE__;
            echo "<br>";
            echo "<br>";
            echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
            die();
        }
    }
}
