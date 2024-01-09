<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    public static function studentIndex($userId)
    {
        return Student::where('user_id', '=', $userId)->get();
    }

    public static function storeStudent($request, $userId)
    {
        $newRequest = Arr::add($request, 'user_id', $userId);

        DB::transaction(function () use ($newRequest, $userId) {

            $newStudent = Student::create(Arr::except($newRequest, ['birth_certificate', 'photo']));
            // dd($newRequest);
            if ($newRequest['birth_certificate'] != null) {
                $file = $newRequest['birth_certificate'];
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs("users/birth_certificate/{$userId}/{$newStudent->id}", $originalName);
                $newStudent->update(
                    [
                        'birth_certificate' => $path
                    ]
                );
            }

            if (isset($newRequest['photo']) != null) {
                $file = $newRequest['photo'];
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs("users/student_photo/{$userId}/{$newStudent->id}", $originalName);
                $newStudent->update(
                    [
                        'photo' => $path
                    ]

                );
            }
        });
    }

    public static function updateStudent($request, $id, $userId)
    {
        DB::transaction(function () use ($request, $id, $userId) {
            $student = Student::find($id);
            $student->update(Arr::except($request, ['birth_certificate', 'photo']));
            if (isset($request['birth_certificate']) && $request['birth_certificate'] != null) {

                if ($student->birth_certificate != null && Storage::exists($student->birth_certificate)) {
                    Storage::delete($student->birth_certificate);
                }

                $file = $request['birth_certificate'];
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs("users/birth_certificate/{$userId}/{$student->id}", $originalName);
                $student->update(
                    [
                        'birth_certificate' => $path
                    ]
                );
            }

            if (isset($request['photo']) && $request['photo'] != null) {

                if ($student->photo != null && Storage::exists($student->photo)) {
                    Storage::delete($student->photo);
                }

                $file = $request['photo'];
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs("users/student_photo/{$userId}/{$student->id}", $originalName);
                $student->update(
                    [
                        'photo' => $path
                    ]
                );
            }
        });
    }
}
