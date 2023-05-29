<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Http\Resources\Insights\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvancedSearchController extends Controller
{
    public function organizations(Request $request)
    {
        $organizations = Organization::query();


        $keyword = trim($request->input('keyword'));
        $originalKeyword = $request->input('keyword');
        $categories = $request->input('categories');
        $cities = $request->input('cities');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $statuses = $request->input('statuses');
        $visits = $request->input('visits');

        // keyword
        if (!empty($keyword)) {
            // remove all kinds of white spaces in given keyword
            $keyword = preg_replace('/[ ]{1,}|[\t]|[\n]]/', '', trim($keyword));

            // get similar organizations that matches searched keyword.
            // note that all spaces in organization titles have been ignored.
            $similar_results = DB::select("SELECT id FROM organizations
                            WHERE
                            (REPLACE(title, ' ', '') LIKE '%{$keyword}%'
                            OR `description` LIKE '%{$originalKeyword}%')
                            AND deleted_at IS NULL");

            $similar_results = array_map(function ($item) {
                return $item->id;
            }, $similar_results);

            $organizations->whereIn('id', $similar_results);
        }

        // categories
        if (!empty($categories)) {
            $organizations->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('id', $categories);
            });
        }

        // cities
        if (!empty($cities)) {
            $organizations->whereHas('city', function ($query) use ($cities) {
                $query->whereIn('id', $cities);
            });
        }

        // start_date
        if (!empty($start_date)) {
            $organizations->orWhere('founded_year', '>=', $start_date);
        }

        // end_date
        if (!empty($end_date)) {
            $organizations->orWhere('closed_year', '<=', $end_date);
        }

        // statuses
        if (!empty($statuses)) {
            $organizations->whereIn('status', $statuses);
        }

        $organizations = $organizations->paginate(2);
        return OrganizationResource::collection($organizations);
    }
}
