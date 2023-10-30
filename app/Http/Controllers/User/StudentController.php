<?php

namespace App\Http\Controllers\User;

use App\Enums\GenderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Student;
use App\Models\Transaction;
use App\Services\StudentService;
use Carbon\Carbon;
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
        // dd($student->birth_certificate);
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
        // $participants = [];
        // $userTransactions = Transaction::where('user_id', Auth::user()->id)->get();
        // foreach ($userTransactions as $transaction) {
        //     foreach ($transaction->orders as $order) {
        //         if ($order->training->start_date > Carbon::now()) {
        //             foreach ($order->orderParticipants as $participant) {
        //                 $participants[] = $participant->student_id;
        //             }
        //         }
        //     }
        // }

        $userTransactions = Transaction::with('orders')->where('user_id', Auth::user()->id)->get();
        $boughtParticipants = $userTransactions->flatMap(function ($transaction) {
            return $transaction->orders->flatMap(function ($order) {
                if ($order->training->start_date >= Carbon::now()) {
                    return $order->orderParticipants->pluck('student_id');
                }
                return [];
            });
        });

        $orderedParticipant = Cart::with('items')->where('user_id', '=', Auth::user()->id)->get()->flatMap(function ($cart) {
            return $cart->items->pluck('student_id');
        });

        $collection1 = collect($boughtParticipants);
        $collection2 = collect($orderedParticipant);

        $mergedCollection = $collection1->merge($collection2);

        $participantIds = $mergedCollection->all();

        // dd($participantIds);

        $trainer = Student::when($request->has('q'), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->q}%");
        })
            ->when($request->extraData['gender'] != null, function ($q) use ($request) {
                $q->where('gender', '=', "{$request->extraData['gender']}");
            })
            ->when($request->extraData['birth_date'] != null, function ($q) use ($request) {
                $q->whereDate('birth_date', '>', "{$request->extraData['birth_date']}");
            })
            ->where('user_id', '=', Auth::user()->id)
            ->whereNotIn('students.id', $participantIds)
            // ->orWhereNotIn('students.id', $orderedParticipant)
            ->limit(10)
            ->get();

        // if ($request->extraData['gender'] != null) {
        //     return response()->json($request->extraData['gender'], 200);
        // }
        // return response()->json($request->extraData, 200);
        return response()->json($trainer, 200);
    }
}
