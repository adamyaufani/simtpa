<?php

namespace App\Services;

use App\Models\Agreement;

class AgreementService
{

    public static function index()
    {
        $agreements = Agreement::all();
    }
}
