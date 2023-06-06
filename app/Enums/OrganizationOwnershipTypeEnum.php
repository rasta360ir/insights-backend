<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrganizationOwnershipTypeEnum: string
{
    use EnumToArray;

    case Private = 'private';
    case Limited = 'limited';
    case Solidarity = 'solidarity';
    case Cooperative = 'cooperative';
    case Public = 'public';
}
