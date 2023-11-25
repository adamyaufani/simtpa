<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderParticipant;
use App\Models\Training;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function attendance($id)
    {
        $training = Training::with('orders', 'orders.orderParticipants', 'orders.orderParticipants.student')->find($id);
        // $participants = [];
        // foreach ($training->orders as $order) {
        //     foreach ($order->orderParticipants as $participant) {
        //         $participants[] = $participant->student;
        //     }
        // }
        $participants = $training->orders->flatMap(function ($order) {
            return $order->orderParticipants->pluck('student');
        })->all();
        // dd($participants);
        return view('admin.pages.training.attendance', compact('training', 'participants'));
    }

    public function scan()
    {
    }
}
