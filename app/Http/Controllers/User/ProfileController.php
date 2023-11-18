<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $userProfile = UserProfile::where('user_id', Auth::user()->id)->first();
        $villages = Village::all();

        return view('user.pages.profile.detail')
            ->with(compact('userProfile', 'villages'));
    }

    public function update($id, UpdateUserProfileRequest $request)
    {
        $userProfile = UserProfile::find($id);
        if ($userProfile->user_id != Auth::user()->id) {
            abort(403);
        }

        // dd($request->validated());
        $userProfile->update(Arr::except($request->validated(), ['sk_file']));

        if ($request->hasFile('sk_file')) {
            if ($userProfile->sk_file != null) {
                if (Storage::exists(Crypt::decryptString($userProfile->sk_file))) {
                    Storage::delete(Crypt::decryptString($userProfile->sk_file));
                }
            }

            $file = $request->file('sk_file');
            $originalFileName = $file->getClientOriginalName();
            $userId = Auth::user()->id;

            $filePath = $file->storeAs("users/file_sk/{$userId}", $originalFileName);

            $userProfile->update([
                'sk_file' => $filePath
            ]);
        }

        if ($request->hasFile('organization_building_photo')) {
            if ($userProfile->organization_building_photo != null) {
                if (Storage::exists(Crypt::decryptString($userProfile->organization_building_photo))) {
                    Storage::delete(Crypt::decryptString($userProfile->organization_building_photo));
                }
            }

            $file = $request->file('organization_building_photo');
            $originalFileName = $file->getClientOriginalName();
            $userId = Auth::user()->id;

            $filePath = $file->storeAs("users/file_sk/{$userId}", $originalFileName);

            $userProfile->update([
                'organization_building_photo' => $filePath
            ]);
        }

        if ($request->hasFile('organization_logo')) {
            if ($userProfile->organization_logo != null) {
                if (Storage::exists(Crypt::decryptString($userProfile->organization_logo))) {
                    Storage::delete(Crypt::decryptString($userProfile->organization_logo));
                }
            }

            $file = $request->file('organization_logo');
            $originalFileName = $file->getClientOriginalName();
            $userId = Auth::user()->id;

            $filePath = $file->storeAs("users/file_sk/{$userId}", $originalFileName);

            $userProfile->update([
                'organization_logo' => $filePath
            ]);
        }

        return redirect()->route('user.profile')->with('success', 'Berhasil mengubah data profil');
    }
}
