<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventAttendance;
use App\Models\OrderParticipant;
use App\Models\Training;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function attendance($id)
    {
        $training = Training::with('orders', 'orders.orderParticipants', 'orders.orderParticipants.student', 'orders.orderParticipants.eventAttendance')->find($id);
        // $participants = [];
        // foreach ($training->orders as $order) {
        //     foreach ($order->orderParticipants as $participant) {
        //         $participants[] = $participant->student;
        //     }
        // }
        // dd($training);
        $participants = $training->orders->flatMap(function ($order) {
            return $order->orderParticipants;
        })->all();

        // [
        //         'student' => ,
        //         'attendance_status' => $order->orderParticipants->pluck('eventAttendance')
        //     ];

        // foreach ($participants as $participant) {
        //     dump($participant->pluck('eventAttendance'));
        // }
        // dd($participants);
        return view('admin.pages.training.attendance', compact('training', 'participants'));
    }

    // public function scan($id)
    // {
    //     $orderParticipant = OrderParticipant::with('order')->find($id);
    //     $attendance = EventAttendance::where('order_participant_id', $id);
    //     // dd($orderParticipant->order->training_id);
    //     if ($attendance->count() == 0) {
    //         EventAttendance::create([
    //             'order_participant_id' => $id,
    //             'status' => 'Hadir'
    //         ]);
    //     }

    //     return redirect()->to(route('admin.training_attendance', $orderParticipant->order->training_id))->with('success', 'Data absensi berhasil dimasukkan.');
    // }

    public function scan($id)
{
    $orderParticipant = OrderParticipant::with('order')->find($id);

    if ($orderParticipant) {
        $attendance = EventAttendance::where('order_participant_id', $id);

        if ($attendance->count() == 0) {
            EventAttendance::create([
                'order_participant_id' => $id,
                'status' => 'Hadir'
            ]);

            return response()->json(['message' => 'Attendance recorded successfully']);
        }

        return response()->json(['message' => 'Attendance already recorded']);
    }

    return response()->json(['message' => 'Participant not found']);
}

}
