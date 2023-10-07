<?php

namespace App\Enums;

enum LastFormalEducationEnum: string
{
    case TIDAK_ADA = 'Tidak memiliki pendidikan formal';
    case SD_SEDERAJAT = 'SD/MI/Sederajat';
    case SMP_SEDERAJAT = 'SMP/MTs/Sederajat';
    case SMA_SEDERAJAT = 'SMA/MA/Sederajat';
    case D1 = 'D1';
    case D2 = 'D2';
    case D3 = 'D3';
    case S1_D4 = 'S1/D4';
    case S2 = 'S2';
    case S3 = 'S3';
}
