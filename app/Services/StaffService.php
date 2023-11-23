<?php

namespace App\Services;

use App\Models\Staff;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $newStaff = Staff::create($staffData);

            if (isset($staffData['photo']) != null) {
                $file = $staffData['photo'];
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs("users/staff_photo/{$userId}/{$newStaff->id}", $originalName);
                $newStaff->update(
                    [
                        'photo' => $path
                    ]
                );
            }
        });
    }

    public static function updateStaff($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $staff =  Staff::find($id);
            $staff->update($request);
            $userId = $staff->user->id;
            if (isset($request['photo']) && $request['photo'] != null) {

                if ($staff->photo != null && Storage::exists($staff->photo)) {
                    Storage::delete($staff->photo);
                }

                $file = $request['photo'];
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs("users/staff_photo/{$userId}/{$staff->id}", $originalName);
                $staff->update(
                    [
                        'photo' => $path
                    ]
                );
            }
        });
    }
}
