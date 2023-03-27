<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Http\Resources\Insights\HubResource;
use App\Models\Hub;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HubController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $hubs = Hub::query()->latest('id')->get();

        return HubResource::collection($hubs);
    }
}
