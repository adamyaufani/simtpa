<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->status == 'denied-user', function ($query) {
            $query->verificationDenied();
        })
            ->when($request->status == 'waiting-verification', function ($query) {
                $query->waitingVerification();
            })
            ->when($request->status == 'verified', function ($query) {
                $query->verified();
            })
            ->get();

        return view('admin.pages.users.index')
            ->with(compact('users'));
    }
}
