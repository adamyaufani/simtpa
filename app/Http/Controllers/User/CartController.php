<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentMethodEnum;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\CartService;

class CartController extends Controller
{
    public function index()
    {
        $items = CartService::cartItems(Auth::id());
        return view('user.pages.cart.index')->with(['orders' => $items]);
    }

    public function destroy($id)
    {
        $item = Cart::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }

    public function buy()
    {
        $items = CartService::cartItems(Auth::id());
        $paymentMethods = PaymentMethodEnum::cases();
        return view('user.pages.cart.buy')->with(
            [
                'orders' => $items,
                'paymentMethods' => $paymentMethods
            ]
        );
    }
}
