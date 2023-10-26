<?php

namespace App\Enums;

enum GenderRequirementEnum: string
{
    case Male = 'laki-laki';
    case Female = 'perempuan';
    case Both = 'laki-laki dan perempuan';
}
