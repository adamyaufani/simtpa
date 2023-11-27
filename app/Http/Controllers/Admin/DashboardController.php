<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Cart;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {

        // $trainings = Training::all();
        $trainings = Training::withCount('participants')->get();
        $cart = Cart::withCount('items')->get();

        // dd($cart);
        

        return view('admin.pages.training.participant-training')
            ->with(compact('trainings', 'cart'));     
    }
}
