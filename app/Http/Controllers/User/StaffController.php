<?php

namespace App\Http\Controllers\User;

use App\Enums\EmploymentStatusEnum;
use App\Enums\LastFormalEducationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = StaffService::staffIndex(Auth::user()->id);
        return view('user.pages.staff.index')
            ->with(compact('staffs'));
    }

    public function create()
    {
        return view('user.pages.staff.create')
            ->with([
                'employment_statuses' => EmploymentStatusEnum::cases(),
                'last_formal_educations' => LastFormalEducationEnum::cases()
            ]);
    }

    public function store(StoreNewStaffRequest $request)
    {
        StaffService::storeStaff($request->validated(), Auth::user()->id);

        return redirect()->back()->with('success', 'Berhasil menambahkan staff baru');
    }

    public function edit($id)
    {
        $staff = Staff::find($id);
        if ($staff->user_id != Auth::user()->id) {
            abort(403);
        }
        return view('user.pages.staff.edit')
            ->with(
                [
                    'staff' => $staff,
                    'employment_statuses' => EmploymentStatusEnum::cases(),
                    'last_formal_educations' => LastFormalEducationEnum::cases()
                ]
            );
    }

    public function destroy($id)
    {
        $staff = Staff::find($id);
        if ($staff->user_id != Auth::user()->id) {
            abort(403);
        }
        $staff->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data staff');
    }

    public function staffByName(Request $request)
    {
        $trainer = Staff::when($request->has('q'), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->q}%");
        })
            ->where('user_id', '=', Auth::user()->id)
            ->limit(10)
            ->get();

        return response()->json($trainer, 200);
    }

    public function update($id, UpdateStaffRequest $request)
    {
        $staff = Staff::find($id);
        if ($staff->user_id != Auth::user()->id) {
            abort(403);
        }
        StaffService::updateStaff($request->validated(), $id, Auth::user()->id);

        return redirect()->back()->with('success', 'Berhasil mengubah data staff');
    }
}
