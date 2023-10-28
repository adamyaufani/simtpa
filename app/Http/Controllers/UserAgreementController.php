<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\UserAgreement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserAgreementController extends Controller
{
    public function index()
    {

        // $agreements = Agreement::all();

        // return view('admin.pages.agreement.index')
        //     ->with(compact('agreements'));
        $current_agreement = Agreement::where([
            ['year_start', '<=', Carbon::now()->format('Y-m-d')],
            ['year_end', '>=', Carbon::now()->format('Y-m-d')],
        ])->first();

        return view('user.pages.agreement')
            ->with(compact('current_agreement'));
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
