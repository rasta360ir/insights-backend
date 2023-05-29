<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum OrganizationTypeEnum: string
{
    use EnumToArray;

    case Startup_Studio = 'startup-studio';
    case Foreign_Investor = 'foreign-investor';
    case Corporate_Venture_Capitalist = 'corporate-venture-capitalist';
    case Major_Investor = 'major-investor';
    case Government_Investor = 'government-investor';
    case Angel_Investor = 'angel-investor';
    case Accelerator = 'accelerator';
    case Venture_Capital_Company = 'venture-capital-company';
    case Research_Fund = 'research-fund';
    case Venture_Capital_Fund = 'venture-capital-fund';
    case Business = 'business';
    case Innovation_Center = 'innovation-center';
    case Investment_Holding = 'investment-holding';
    case Other = 'other';
}
