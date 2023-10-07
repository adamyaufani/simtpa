<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdministratorRequest;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function show()
    {
        $administrator = Administrator::firstOrCreate(['user_id' => Auth::user()->id]);

        return view('user.pages.organization.index')
            ->with(compact('administrator'));
    }

    public function update($id, UpdateAdministratorRequest $request)
    {
        $administrator = Administrator::find($id);

        $administrator->fill($request->validated());
        $administrator->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data administrator');
    }
}
