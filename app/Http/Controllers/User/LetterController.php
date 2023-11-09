<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\User;
use App\Models\UserLetterStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function index()
    {
        $letters = Letter::with('userLetterStatuses')->get();
        return view('user.pages.letter.index')
            ->with(compact('letters'));
    }

    public function show($id)
    {
        $letterStatus = UserLetterStatus::where([['letter_id', '=', $id], ['user_id', '=', Auth::user()->id]])->exists();
        if ($letterStatus == false) {
            UserLetterStatus::create([
                'letter_id' => $id,
                'user_id' => Auth::user()->id,
            ]);
        }

        $letter = Letter::find($id);
        $user = User::find(Auth::user()->id);
        $pdf = Pdf::loadView('user.pages.letter.detail', compact('letter', 'user'));

        return view('user.pages.letter.detail')
            ->with(compact('letter', 'user'));
        // return $pdf->download('invoice.pdf');
    }
}
