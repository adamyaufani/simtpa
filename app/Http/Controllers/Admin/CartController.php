<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $users = CartService::cartIndexForAdmin();

        return view('admin.pages.cart.index')
            ->with(compact('users'));
    }
}
