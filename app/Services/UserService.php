<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            ->orderBy('verification_status', 'asc')
            ->get();
        // ->paginate(10)->withQueryString();

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

    public static function denyUserRegistration()
    {
        $user = static::$user;

        DB::transaction(function () use ($user) {
            $user->update([
                'verification_status' => 3,
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

    public static function updateUserProfile($request)
    {
        DB::transaction(function () use ($request) {
            $user = static::$user;

            $userProfile = $user->userProfile;

            $userProfile->update(Arr::except($request->validated(), ['sk_file']));

            if ($request->hasFile('sk_file')) {
                if ($userProfile->sk_file != null) {
                    if (Storage::exists(Crypt::decryptString($userProfile->sk_file))) {
                        Storage::delete(Crypt::decryptString($userProfile->sk_file));
                    }
                }

                $file = $request->file('sk_file');
                $originalFileName = $file->getClientOriginalName();
                $userId = $user->id;

                $filePath = $file->storeAs("users/file_sk/{$userId}", $originalFileName);

                $userProfile->update([
                    'sk_file' => $filePath
                ]);
            }
        });
    }
}
