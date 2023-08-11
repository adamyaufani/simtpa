<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserService::userIndex($request);

        return view('admin.pages.users.index')
            ->with(compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user->verification_status == 0) {
            return redirect()->to(route('admin.verify_user', $user->id));
        }
    }

    public function userRegistrationDetail($id)
    {
        $user = User::find($id);

        return view('admin.pages.users.detail')
            ->with(compact('user'));
    }

    public function verifyUser($id)
    {
        UserService::detailUser($id)->verifyUser();

        return redirect()->back()->with('succeed', 'Pendaftaran Diterima');
    }
}
