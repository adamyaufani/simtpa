<?php

namespace App\Services;

use App\Models\OrderParticipant;

class CertificateSerivce
{

    public static function certificateIndex()
    {
        $userId = auth()->user()->id;
        // $userId = 2;
        $certificates = OrderParticipant::has('eventAttendance')
            ->with([
                'student',
                'staff',
                'order',
                'order.training',
                'order.transaction'
            ])
            ->whereHas('order.transaction', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->get();
        return $certificates;
    }

    public static function certificateDetail($orderParticipantId)
    {
        $certificate = OrderParticipant::has('eventAttendance')
            ->with('student', 'staff', 'order', 'order.training')
            ->where('id', '=', $orderParticipantId)
            ->first();
        return $certificate;
    }
}
