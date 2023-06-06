<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Http\Resources\Insights\OrganizationResource;
use App\Models\Organization;
use App\Services\Insights\OrganizationService;
use Illuminate\Http\Response;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::query()
            ->oldest('id')
            ->paginate(10);

        return $organizations;
    }


    /**
     * Display the specified resource.
     *
     * @param  Organization  $organization
     * @return Response
     */
    public function show(Organization $organization)
    {
        return new OrganizationResource($organization);
    }

    /**
     * Get statistics for the specified organization.
     */
    public function statistics(Organization $organization)
    {
        return OrganizationService::getStatistics($organization);
    }


    /**
     * Get competitors for the specified organization.
     */
    public function competitors(Organization $organization)
    {
        $competitors = OrganizationService::getCompetitors($organization);

        return OrganizationResource::collection($competitors);
    }


    /**
     * Get news for the specified organization.
     */
    public function news(Organization $organization)
    {
        return OrganizationService::getNews($organization, 4);
    }

    public function faq(Organization $organization)
    {
        return OrganizationService::getFAQ($organization);
    }
}
