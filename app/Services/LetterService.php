<?php

namespace App\Services;

use App\Models\Letter;
use Illuminate\Support\Facades\DB;

final class LetterService
{
    public static $letter;

    public static function detailLetter($ltterId)
    {
        static::$letter = Letter::find($ltterId);
        return new static;
    }

    public static function storeLetter($request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();

            Letter::create($data);
        });
    }

    public static function updateLetter($request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $letter = static::$letter;

            $letter->update($data);
        });
    }

    public static function deleteLetter()
    {
        DB::transaction(function () {
            $letter = static::$letter;

            $letter->delete();
        });
    }
}
