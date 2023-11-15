<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GenderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $gender = GenderEnum::cases();
        $student = Student::find($id);
        return view('admin.pages.student.show')
            ->with(compact('student', 'gender'));
    }

    public function update($id, UpdateStudentRequest $request)
    {
        $userId = Student::find($id)->user->id;
        StudentService::updateStudent($request->validated(), $id, $userId);
        return redirect()->back()->with('success', 'Berhasil mengubah data santri');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        $student->delete();

        return redirect()->back()->with('success', 'Data Santri berhasil dihapus');
    }
}
