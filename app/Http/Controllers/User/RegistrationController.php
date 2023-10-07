<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public function form()
    {
        if (Auth::check()) {


            return redirect()->to(route('user.homepage'));
        }
        $villages = Village::all();

        return view('user.pages.register')->with(compact('villages'));
    }

    public function register(UserRegistrationRequest $request)
    {
        $validated_request = $request->validated();

        $user = new User;
        $user->email = $validated_request['email'];
        $user->password = $validated_request['password'];
        $user->verification_status = '0';
        $user->save();

        $profile = new UserProfile;
        $profile->user_id = $user->id;
        $profile->institution_name  = $validated_request['institution_name'];
        $profile->phone_number  = $validated_request['phone'];
        $profile->address  = $validated_request['address'];
        $profile->village  = $validated_request['village'];
        $profile->save();

        // dd($validated_request);

        // $user = User::create(Arr::add($validated_request, 'verification_status', 0));


        // UserProfile::create(Arr::add($validated_request, 'verification_status', 0));

        return redirect()->back()->with('success', 'Akun berhasil didaftarkan. Mohon tunggu verifikasi dari admin untuk bisa login ke akun anda.');
    }
}
