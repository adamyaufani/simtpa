<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\UserAgreement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgreementController extends Controller
{
    public function index()
    {
        return view('user.pages.agreement');
    }

    public function sign()
    {
        $current_agreement = Agreement::where([
            ['year_start', '<=', Carbon::now()->format('Y-m-d')],
            ['year_end', '>=', Carbon::now()->format('Y-m-d')],
        ])->first();

        UserAgreement::create([
            'user_id' => Auth::id(),
            'agreement_id' => $current_agreement->id,
            'sign' => 1
        ]);

        return redirect()->intended();
    }
}
