<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrganizationStatusEnum: string
{
    use EnumToArray;

    case Active = 'active';
    case Deactivated = 'deactivated';
    case Closed = 'closed';
}
