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
        $agreements = Agreement::orderBy('created_at', 'desc')->paginate(1);
        return view('admin.pages.agreement.index')
            ->with(compact('agreements'));
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

    public function edit($id)
    {
        $agreement = Agreement::findOrFail($id);

        return view('admin.pages.agreement.edit')
            ->with(compact('agreement'));
    }

    public function update($id, StoreNewAgreementRequest $request)
    {
        $agreement = Agreement::findOrFail($id);
        DB::transaction(function () use ($request, $agreement) {
            $agreement->update($request->validated());
        });
        return redirect()->back()->with('success', 'Syarat dan Persetujuan berhasil diupdate');
    }
}
