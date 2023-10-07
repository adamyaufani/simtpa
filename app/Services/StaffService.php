<?php

namespace App\Services;

use App\Models\Staff;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StaffService
{
    public static function staffIndex($userId)
    {
        return Staff::where('user_id', '=', $userId)->get();
    }

    public static function storeStaff($request, $userId)
    {
        DB::transaction(function () use ($request, $userId) {
            $staffData = Arr::add($request, 'user_id', $userId);
            Staff::create($staffData);
        });
    }

    public static function updateStaff($request, $id, $userId)
    {
        DB::transaction(function () use ($request, $id, $userId) {
            Staff::where(['id' => $id, 'user_id' => $userId])->update($request);
        });
    }
}
