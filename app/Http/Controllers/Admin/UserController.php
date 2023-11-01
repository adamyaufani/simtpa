<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewUserRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserService::userIndex($request);
        $profile = UserProfile::all();


        return view('admin.pages.users.index')
            ->with(compact('users', 'profile'));
    }

    public function show($id)
    {
        $user = User::with('userProfile.villageDetail')->find($id);
        if ($user->verification_status == 0) {
            return redirect()->to(route('admin.verify_user', $user->id));
        }

        // dd($user->userProfile->villageDetail);
        return view('admin.pages.users.detail')
            ->with(compact('user'));
    }

    public function userRegistrationDetail($id)
    {
        $user = User::find($id);

        if ($user->verification_status == 1) {
            return redirect()->to(route('admin.detail_user', $user->id));
        }

        return view('admin.pages.users.verify')
            ->with(compact('user'));
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(StoreNewUserRequest $request)
    {
        UserService::storeNewUser($request->validated());
        return redirect()->to(route('admin.user_index'))->with('success', 'Pengguna baru berhasil ditambahkan');
    }

    public function verifyUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->verification_status == 0) {
            UserService::detailUser($id)->verifyUser();

            return redirect()->back()->with('succeed', 'Pendaftaran Diterima');
        }
        return redirect()->back()->with('error', 'Terjadi Kesalahan');
    }

    public function banned($id)
    {
        $user = User::findOrFail($id);
        if ($user->verification_status == 1) {
            UserService::detailUser($id)->bannedUser();

            return redirect()->back()->with('success', 'Pendaftaran Diterima');
        }
        return redirect()->back()->with('error', 'Terjadi Kesalahan');
    }

    public function unbanned($id)
    {
        $user = User::findOrFail($id);
        if ($user->verification_status == 2) {
            UserService::detailUser($id)->unbannedUser();

            return redirect()->back()->with('success', 'Pendaftaran Diterima');
        }
        return redirect()->back()->with('error', 'Terjadi Kesalahan');
    }
}
