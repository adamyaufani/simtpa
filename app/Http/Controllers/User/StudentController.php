<?php

namespace App\Http\Controllers\User;

use App\Enums\GenderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $students = StudentService::studentIndex(Auth::id());
        return view('user.pages.student.index')->with(compact('students'));
    }

    public function create()
    {
        return view('user.pages.student.create');
    }

    public function store(StoreNewStudentRequest $request)
    {
        StudentService::storeStudent($request->validated(), Auth::id());

        return redirect()->back()->with('success', 'Berhasil menambahkan santri baru');
    }

    public function edit($id)
    {
        $gender = GenderEnum::cases();
        $student = Student::find($id);
        if ($student->user_id != Auth::user()->id) {
            abort(403);
        }
        return view('user.pages.student.edit')->with(compact('student', 'gender'));
    }

    public function update($id, UpdateStudentRequest $request)
    {
        StudentService::updateStudent($request->validated(), $id, Auth::id());

        return redirect()->back()->with('success', 'Berhasil mengubah data santri');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student->user_id != Auth::user()->id) {
            abort(403);
        }

        $student->delete();

        return redirect()->back()->with('success', 'Data Santri berhasil dihapus');
    }

    public function studentByName(Request $request)
    {
        $trainer = Student::when($request->has('q'), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->q}%");
        })
            ->where('user_id', '=', Auth::user()->id)
            ->limit(10)
            ->get();

        return response()->json($trainer, 200);
    }
}
