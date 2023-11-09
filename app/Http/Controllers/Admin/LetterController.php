<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLetterRequest;
use App\Models\Letter;
use App\Services\LetterService;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function index()
    {
        $letters = Letter::all();
        return view('admin.pages.letter.index')
            ->with(compact('letters'));
    }

    public function show($id)
    {
        $letter = Letter::find($id);
        return view('admin.pages.letter.detail')
            ->with(compact('letter'));
    }

    public function create()
    {
        return view('admin.pages.letter.create');
    }

    public function store(StoreLetterRequest $request)
    {
        LetterService::storeLetter($request);
        return redirect()->to(route('admin.letter_index'))->with('success', 'Surat berhasil dibuat.');
    }

    public function update($id, StoreLetterRequest $request)
    {
        LetterService::detailLetter($id)->updateLetter($request);
        return redirect()->back()->with('success', 'Surat berhasil dirubah.');
    }

    public function destroy($id)
    {
        LetterService::detailLetter($id)->deleteLetter();
        return redirect()->back()->with('success', 'Surat berhasil dihapus.');
    }
}
