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

 
    public function scan($id)
    {
        
        $orderParticipant = OrderParticipant::with('order')->find($id);

        // dd($orderParticipant->staff->gender);

        if($orderParticipant->staff->gender == 'perempuan') {
            $gelar ='Ustadzah';
        } else {
            $gelar ='Ustadz';
        }
        // dd($orderParticipant->order->training->participant_type);

        if ($orderParticipant) {
            $attendance = EventAttendance::where('order_participant_id', $id);

            if ($attendance->count() == 0) {
                EventAttendance::create([
                    'order_participant_id' => $id,
                    'status' => 'Hadir'
                ]);

                $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.fonnte.com/send',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_SSL_VERIFYPEER => FALSE,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'target' => $orderParticipant->staff->phone,
                            'message' => 'Assalamualaikum, '. $gelar .' ' . $orderParticipant->staff->name . '.
Selamat mengikut acara *'. $orderParticipant->order->training->name .'*. 
Semoga acara hari ini memberikan banyak manfaat dan meninggalkan kesan yang baik bagi '. $gelar .'.
                            
Selanjutnya, untuk meningkatkan kualitas pelayanan kami, mohon kesediaan '. $gelar .' ' . $orderParticipant->staff->name . ' untuk mengisi kuesioner berikut ini https://badkokasihan.web.id/kuesioner?id=' . $orderParticipant->staff->id . '. Setelah mengisi kuesioner,  '. $gelar .' akan diarahkan menuju link download sertifikat.

Sampai jumpa pada acara Badko TKA-TPA Kasihan berikutnya.
Terima kasih
💓 Badko Rayon Kasihan',
                            'countryCode' => '62', //optional
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: nHypEJ4GhmFX4_tboRqk' //change TOKEN to your actual token
                        ),
                    ));
                
                    $response = curl_exec($curl);

                    curl_close($curl);

                    if($response) {
                    
                        return response()->json(['message' => 'Presensi Berhasil', 'status' => '1']);

                    }    

                
            }

            return response()->json(['message' => 'Peserta sudah presensi.', 'status' => '2']);
        }

        return response()->json(['message' => 'Peserta tidak ditemukan', 'status' => '3']);
    }
}
