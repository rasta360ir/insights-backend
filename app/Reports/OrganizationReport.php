<?php

namespace App\Reports;

use App\Http\Resources\Insights\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrganizationReport
{
    public function mostVisited(Request $request, $defaultCount = 10): AnonymousResourceCollection
    {
        $data = $request->validate([
            'count' => ['nullable', 'integer']
        ]);

        $limit = $data['count'] ?? $defaultCount;
        $organizations = DB::select("SELECT organization_id, COUNT(organization_id) AS count FROM user_organization_visits GROUP BY organization_id ORDER BY count DESC LIMIT $limit");

        $organizations = array_map(function ($item) {
            $organization = Organization::query()->find($item->organization_id);
            $organization->visits_count = $item->count;
            return $organization;
        }, $organizations);

        return OrganizationResource::collection($organizations);
    }
}
