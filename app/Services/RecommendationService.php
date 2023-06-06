<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

class RecommendationService
{
    public static function recommend($limit): Collection|array
    {
        return Organization::query()->inRandomOrder()->take($limit)->get();
    }
}
