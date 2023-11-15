<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentStatusEnum;
use App\Enums\LastFormalEducationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewStaffRequest;
use App\Models\Staff;
use App\Services\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('admin.pages.staff.index')
            ->with(compact('staffs'));
    }

    public function show($id)
    {
        $staff = Staff::find($id);
        $employment_statuses = EmploymentStatusEnum::cases();
        $last_formal_educations = LastFormalEducationEnum::cases();
        return view('admin.pages.staff.show')
            ->with(compact('staff', 'employment_statuses', 'last_formal_educations'));
    }

    public function update($id, StoreNewStaffRequest $request)
    {
        StaffService::updateStaff($request->validated(), $id);
        return redirect()->back()->with('success', 'Berhasil mengubah data staff');
    }

    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data staff');
    }
}
