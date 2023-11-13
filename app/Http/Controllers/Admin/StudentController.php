<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.pages.student.index')
            ->with(compact('students'));
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('admin.pages.student.show')
            ->with(compact('student'));
    }
}
