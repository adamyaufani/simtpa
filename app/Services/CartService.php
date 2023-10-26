<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CartService
{
    public static function cartItems($userId)
    {
        $items = Cart::where('user_id', $userId)
            ->with([
                'training',
                'items'
            ])
            ->get();

        $data = collect($items)->map(function ($item) {
            $item['price'] = $item['training']['price_normal'] * $item['items']->count();
            return $item;
        })->toArray();

        $totalPrice = collect($data)->pluck('price')->flatten()->sum();

        $finalData = [
            'items' => $data,
            'total_price' => $totalPrice
        ];

        return $finalData;
    }

    public static function addToCart($userId, $request)
    {
        DB::transaction(function () use ($userId, $request) {
            $validated = $request->validated();
            $cart = Cart::create([
                'user_id' => $userId,
                'training_id' => $validated['training_id'],
            ]);
            foreach ($validated['student_id'] as $item) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'student_id' => $item,
                ]);
            }
        });
    }
}
