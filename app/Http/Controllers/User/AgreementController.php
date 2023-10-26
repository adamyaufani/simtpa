<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewAgreementRequest;
use App\Models\Agreement;
use App\Models\UserAgreement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgreementController extends Controller
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

    public function create()
    {
        session(['url.intended' => url()->previous()]);
        return view('admin.pages.agreement.create');
    }

    public function store(StoreNewAgreementRequest $request)
    {
        // dd($request->validated());
        DB::transaction(function () use ($request) {
            Agreement::create($request->validated());
        });

        return redirect()->back()->with('success', 'Syarat dan Persetujuan berhasil diupdate');
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
