<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    static $user;

    public static function userIndex($request)
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
            ->paginate(10)->withQueryString();

        return $users;
    }

    public static function detailUser($id)
    {
        static::$user =  User::find($id);
        return new static;
    }

    public static function verifyUser()
    {
        $user = static::$user;

        DB::transaction(function () use ($user) {
            $user->update([
                'verification_status' => 1,
                'verification_date' => now()
            ]);
        });
    }
}
