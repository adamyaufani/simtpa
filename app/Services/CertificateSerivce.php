<?php

namespace App\Services;

use App\Models\OrderParticipant;

class CertificateSerivce
{

    public static function certificateIndex()
    {
        $certificates = OrderParticipant::has('eventAttendance')
            ->with('student', 'staff', 'order', 'order.training')
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
