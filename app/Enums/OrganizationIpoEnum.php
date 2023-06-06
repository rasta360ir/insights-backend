<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrganizationIpoEnum: string
{
    use EnumToArray;

    case Public = 'public';
    case Private = 'private';
    case Delisted = 'delisted';
}
