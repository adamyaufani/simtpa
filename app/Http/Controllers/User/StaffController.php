<?php

namespace App\Http\Controllers\User;

use App\Enums\EmploymentStatusEnum;
use App\Enums\LastFormalEducationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Cart;
use App\Models\Staff;
use App\Models\Transaction;
use App\Services\StaffService;
use Carbon\Carbon;
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

    public function selectStaffByName(Request $request)
    {
        $userTransactions = Transaction::with('orders')->where('user_id', Auth::user()->id)->get();
        $boughtParticipants = $userTransactions->flatMap(function ($transaction) {
            return $transaction->orders->flatMap(function ($order) {
                if ($order->training->start_date >= Carbon::now()) {
                    return $order->orderParticipants->pluck('staff_id');
                }
                return [];
            });
        });

        $orderedParticipant = Cart::with('items')->where('user_id', '=', Auth::user()->id)->get()->flatMap(function ($cart) {
            return $cart->items->pluck('staff_id');
        });

        $collection1 = collect($boughtParticipants);
        $collection2 = collect($orderedParticipant);


        $mergedCollection = $collection1->merge($collection2);

        $participantIds = $mergedCollection->all();

        // $participantIds = [0 => null];

        // dd($participantIds);

        $trainer = Staff::when($request->has('q'), function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->q}%");
        })
            ->when($request->extraData['gender'] != null, function ($q) use ($request) {
                $q->where('gender', '=', "{$request->extraData['gender']}");
            })
            // ->when($request->extraData['birth_date'] != null, function ($q) use ($request) {
            //     $q->whereDate('birth_date', '>', "{$request->extraData['birth_date']}");
            // })
            ->where('user_id', '=', Auth::user()->id)
            ->whereNotIn('staffs.id', $participantIds)
            // ->orWhereNotIn('students.id', $orderedParticipant)
            ->limit(10)
            ->get();

        // dd($trainer);

        // if ($request->extraData['gender'] != null) {
        //     return response()->json($request->extraData['gender'], 200);
        // }
        // return response()->json($request->extraData, 200);
        return response()->json($trainer, 200);
    }
}
