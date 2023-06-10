<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\StoreParticipantRequest;
use App\Models\Order;
use App\Models\Training;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
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

        $order = OrderService::detailOrder($id);

        if ($order['order']['payment_method']->value == 'Transfer') {
            return view('user.pages.order.detail')
                ->with([
                    'data' => $order
                ]);
        }

        if ($order['order']['payment_method']->value == 'Midtrans') {
            return "Midtrans Payment";
        }
    }

    public function placeOrder(StoreParticipantRequest $request)
    {
        $userId = Auth::id();
        $orderId = OrderService::createOrder($request->validated(), $userId);
        return redirect()->to(route('user.detail_order', $orderId));
    }
}
