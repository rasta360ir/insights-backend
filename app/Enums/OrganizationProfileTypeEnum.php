<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrganizationProfileTypeEnum: string
{
    use EnumToArray;

    case Organization = 'organization';
    case Investment_Firm = 'investment-firm';
}
