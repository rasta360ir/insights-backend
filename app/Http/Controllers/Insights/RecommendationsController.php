<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Http\Resources\Insights\OrganizationResource;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RecommendationsController extends Controller
{
    public function index(Request $request, $defaultCount = 10): AnonymousResourceCollection
    {
        $data = $request->validate([
            'count' => ['nullable', 'integer']
        ]);

        $limit = $data['count'] ?? $defaultCount;

        $organizations = RecommendationService::recommend($limit);

        return OrganizationResource::collection($organizations);
    }
}
