<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderParticipant;
use App\Models\Participant;
use App\Models\Training;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;

class OrderService
{

    public static $order;

    public static function orderIndex($user_id = null, $request = null)
    {
        return Order::when($user_id != null, function ($q) use ($user_id) {
            $q->where('user_id', '=', $user_id);
        })
            ->paginate(10)
            ->withQueryString();
    }

    public static function createOrder($items, $userId, $request)
    {
        // DB::transaction(function () use ($request, $userId) {

        //     $order = Order::create([
        //         'training_id' => $request['training_id'],
        //         'user_id' => $userId,
        //         'order_date' => now(),
        //     ]);

        //     $amount_of_participants = $request['qty'];

        //     $order_participant = [];
        //     for ($i = 0; $i < $amount_of_participants; $i++) {

        //         $order_participant[] = [
        //             'student_id' => null,
        //             'order_id' => $order->id,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ];
        //     }

        //     OrderParticipant::insert($order_participant);

        //     static::$order = $order->id;
        // });

        // DB::transaction(function () use ($request, $userId) {
        //     $order = Order::create([
        //         'training_id' => $request['training_id'],
        //         'user_id' => $userId,
        //         'order_date' => now(),
        //         'payment_method' => $request['payment_method'],
        //         'payment_amount' => $request['total_price']
        //     ]);

        //     $order_participant = [];

        //     foreach ($request['student_id'] as $participant) {
        //         $order_participant[] = [
        //             'student_id' => $participant,
        //             'order_id' => $order->id,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ];
        //     }

        //     OrderParticipant::insert($order_participant);

        //     static::$order = $order->id;
        // });

        DB::transaction(function () use ($items, $userId, $request) {
            $transaction = Transaction::create([
                'user_id' => $userId,
                'payment_method' => $request['payment_method'],
                'transaction_date' => Carbon::now(),
                'payment_amount' => $items['total_price'],
            ]);

            foreach ($items['items'] as $training) {
                $order = Order::create([
                    'transaction_id' => $transaction->id,
                    'training_id' => $training['training']['id'],
                ]);

                if ($training['training']['participant_type'] == 'santri') {
                    foreach ($training['items'] as $participant) {
                        OrderParticipant::create([
                            'student_id' => $participant['student_id'],
                            'order_id' => $order->id,
                        ]);
                    }
                } else {
                    foreach ($training['items'] as $participant) {
                        OrderParticipant::create([
                            'staff_id' => $participant['staff_id'],
                            'order_id' => $order->id,
                        ]);
                    }
                }
            }

            Cart::where('user_id', '=', $userId)->delete();
            static::$order = $transaction->id;
        });

        return static::$order;
    }

    public static function completeOrder($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            // if (isset($request['payment_method'])) {
            //     $order = Order::create([
            //         'training_id' => $request['training_id'],
            //         'user_id' => $userId,
            //         'order_date' => now(),
            //         'payment_method' => $request['payment_method']
            //     ]);
            // } else {
            //     $order = Order::create([
            //         'training_id' => $request['training_id'],
            //         'user_id' => $userId,
            //         'order_date' => now(),
            //     ]);
            // }


            $training_participants = Arr::except($request, ['training_id']);
            // dd(count($training_participants['id']));

            $participants = [];
            for ($i = 0; $i < count($training_participants['id']); $i++) {
                $participants[] = [
                    'id' => $training_participants['id'][$i],
                    'fullname' => $training_participants['fullname'][$i],
                    'email' => $training_participants['email'][$i],
                ];
            }

            // dd($participants);

            // foreach ($training_participants['email'] as $key => $value) {

            //     $participant = Participant::where([['user_id', '=', $userId], ['email', '=', $value]])->first();

            //     if (!$participant) {
            //         $participant = Participant::create([
            //             'user_id' => $userId,
            //             'fullname' => $training_participants['fullname'][$key],
            //             'email' => $value
            //         ]);
            //     }

            // OrderParticipant::create([
            //     'participant_id' => $participant->id,
            //     'order_id' => $order->id
            // ]);
            // }

            // static::$order = $order->id;
            Participant::upsert($participants, 'id', ['fullname', 'email']);
        });
    }

    public static function detailOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        $training = Training::find($order->training_id);


        if ($order->payment_method->value == "Transfer") {
            $trainingPrice = $trainingPrice = $training->price_normal;

            $totalPrice = $trainingPrice * $order->orderParticipants()->count();

            $participants = [];
            foreach ($order->orderParticipants()->get() as $data) {
                $participants[] = [
                    'id' => $data->student->id,
                    'fullname' => $data->student->name,
                ];
            }

            $data = [
                'order' => $order,
                'training' => $training,
                'trainingPrice' => $trainingPrice,
                'numberOfParticipants' => $order->orderParticipants()->count(),
                'participants' => $participants,
                'totalPrice' => $totalPrice
            ];

            static::$order = $data;
            return new static;
        }

        $trainingPrice = '';
        if (now() < $training->earlybird_end) {
            $trainingPrice = $training->price_earlybird;
        } elseif (now() == $training->start_date) {
            $trainingPrice = $training->price_onsite;
        } else {
            $trainingPrice = $training->price_normal;
        }

        $totalPrice = $trainingPrice * $order->orderParticipants()->count();

        $participants = [];
        foreach ($order->orderParticipants()->get() as $data) {
            $participants[] = [
                'id' => $data->student->id,
                'fullname' => $data->student->name,
            ];
        }

        $data = [
            'order' => $order,
            'training' => $training,
            'trainingPrice' => $trainingPrice,
            'numberOfParticipants' => $order->orderParticipants()->count(),
            'participants' => $participants,
            'totalPrice' => $totalPrice,
        ];

        static::$order = $data;
        return new static;
    }

    public static function confirmOrderPayment($id)
    {
        $order = Transaction::findOrFail($id);

        // dd($order->TransactionStatus);
        if ($order->TransactionStatus != "Lunas" && $order->TransactionStatus != "Expired") {
            $order->update([
                'status' => "Lunas",
                'payment_date' => now()
            ]);
            return $order;
        }

        return null;
    }

    public static function fetch()
    {
        return static::$order;
    }

    public static function checkoutData()
    {
        $order = static::$order;

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');

        // Required
        $transaction_details = array(
            'order_id' => $order['order']['id'],
            'gross_amount' => $order['totalPrice'], // no decimal allowed for creditcard
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'callbacks' => [
                // 'finish' => 'orders/' . $order['order']['order_id']
                'finish' => "https://78bb-2001-448a-4049-21b1-a0b1-1efb-6937-e324.ngrok-free.app/" . 'orders/' . $order['order']['order_id']
            ]
        );

        return $params;
    }

    public static function orderCertificate($id)
    {
    }

    public static function detailOrderByUserId($user_id)
    {
        return Order::where('user_id', $user_id)->get();
    }
}
