<?php

namespace App\Enums\Date;

use App\Traits\EnumToArray;

enum JalaliMonthEnum: int
{
    use EnumToArray;

    case Farvardin = 1;
    case Ordibehesht = 2;
    case Khordad = 3;
    case Tir = 4;
    case Mordad = 5;
    case Shahrivar = 6;
    case Mehr = 7;
    case Aban = 8;
    case Azar = 9;
    case Dey = 10;
    case Bahman = 11;
    case Esfand = 12;
}
