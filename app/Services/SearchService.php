<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\DB;

class SearchService
{
    public static function findOrganizations($keyword = '', $limit = 10)
    {
        // remove all kinds of white spaces in given keyword
        $searchKeyword = preg_replace('/[ ]{1,}|[\t]|[\n]]/', '', trim($keyword));

        // get exact organization that match searched keyword
        $exact_results = Organization::query()->where('title', $searchKeyword)->get()->pluck('id')->toArray();


        // get similar organizations that matches searched keyword.
        // note that all spaces in organization titles have been ignored.
        $similar_results = DB::select("SELECT id FROM organizations
                            WHERE REPLACE(title, ' ', '') LIKE '%{$searchKeyword}%' AND title  <> '$searchKeyword' AND deleted_at IS NULL LIMIT $limit");

        $similar_results = array_map(function ($result) {
            return $result->id;
        }, $similar_results);


        // merge results
        $results = array_merge($exact_results, $similar_results);

        return array_map(function ($result) {
            return Organization::query()->find($result);
        }, $results);
    }
}
