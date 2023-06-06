<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrganizationBusinessModelEnum: string
{
    use EnumToArray;

    case B2B = 'B2B';
    case B2C = 'B2C';
    case C2C = 'C2C';
    case B2B_B2C = 'B2B-B2C';
    case B2C_C2C = 'B2C-C2C';
    case C2B = 'C2B';
    case B2G = 'B2G';
}
