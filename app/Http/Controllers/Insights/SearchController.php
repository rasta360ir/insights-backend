<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Http\Resources\Insights\OrganizationResource;
use App\Models\Organization;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'keyword' => ['nullable', 'string'],
            'count' => ['nullable', 'integer']
        ]);

        $organizations = SearchService::findOrganizations($data['keyword'] ?? null, $data['count'] ?? 10);

        return OrganizationResource::collection($organizations);
    }
}
