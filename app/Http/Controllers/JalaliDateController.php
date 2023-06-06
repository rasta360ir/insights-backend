<?php

namespace App\Http\Controllers;

use App\Enums\Date\JalaliMonthEnum;
use Spatie\LaravelOptions\Options;

class JalaliDateController extends Controller
{
    public function getMonths(): string
    {
        try {
            return Options::forEnum(JalaliMonthEnum::class)->toJson();
        } catch (\Exception $e) {
            return 'something went wrong.';
        }
    }
}
