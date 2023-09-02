<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
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

    public static function bannedUser()
    {
        $user = static::$user;

        DB::transaction(function () use ($user) {
            $user->update([
                'verification_status' => 2,
                'verification_date' => now()
            ]);
        });
    }

    public static function unbannedUser()
    {
        $user = static::$user;

        DB::transaction(function () use ($user) {
            $user->update([
                'verification_status' => 1,
                'verification_date' => now()
            ]);
        });
    }

    public static function storeNewUser($request)
    {
        DB::transaction(function () use ($request) {
            $user_data = Arr::add($request, 'verification_status', 1);
            User::create($user_data);
        });
    }
}
