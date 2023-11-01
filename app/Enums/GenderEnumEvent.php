<?php

namespace App\Enums;

enum GenderEnumEvent: string
{
    case Male = 'putra';
    case Female = 'putri';
    case Both = 'putra & putri';
}
