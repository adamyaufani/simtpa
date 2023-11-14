<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
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
        return view('admin.pages.staff.show')
            ->with(compact('staff'));
    }
}
