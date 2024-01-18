<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\CertificateSerivce;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = CertificateSerivce::certificateIndex();

        // dd($certificates);

        return view('public.certificate.index')
            ->with(compact('certificates'));
    }

    public function show($id)
    {
        $certificate = CertificateSerivce::certificateDetail($id);

        // dd($certificate);

        return view('public.certificate.detail')
            ->with(compact('certificate'));
    }

    public function download($id)
    {
        $certificate = CertificateSerivce::certificateDetail($id);

        // dd($certificate->order->training->background_certificate);

        return view('public.certificate.layout', compact('certificate'));

        $pdf = PDF::loadView('public.certificate.layout', compact('certificate'));

        return $pdf->download('cert.pdf');
    }
}
