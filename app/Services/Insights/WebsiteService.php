<?php

namespace App\Services\Insights;

use App\Models\Organization;

class WebsiteService
{
    public static function lastMonthVisits(Organization $organization)
    {
        $website = $organization->websites()->first();

        if ($website && count($website->websiteLogs) > 0) {
            $website->last_month_visits = $website->websiteLogs()->latest()->first()->visits;
            $website->logs = $website->websiteLogs()->orderBy('year', 'DESC')->orderBy('month', 'DESC')->get();
            return $website;
        }

        return false;
    }

    public static function logs(Organization $organization)
    {
        $website = $organization->websites()->first();

        if ($website) {
            $logs = $website->websiteLogs()->orderBy('year', 'DESC')->orderBy('month', 'DESC')->take(6)->get();

            foreach ($logs as $key => $log) {
                if ($key == $logs->count() - 1) {
                    $log->growth = null;
                } else {
                    $log->growth = WebsiteService::calculateGrowth($log->visits, $logs[$key + 1]->visits);
                }
            }

            return $logs;
        }

        return false;
    }

    private static function calculateGrowth($current, $original)
    {
        if (!is_numeric($current)) {
            $current = 0;
        }

        if (!is_numeric($original)) {
            $original = 0;
        }

        if ($original == 0) {
            return 0;
        }

        $diff = $current - $original;
        $percentChange = ($diff / $original) * 100;

        return round($percentChange, 2);
    }

    public static function averageTotalVisits(Organization $organization)
    {
        $website = $organization->websites()->first();

        if ($website && count($website->websiteLogs) > 0) {
            $average = 0;
            foreach ($website->websiteLogs as $log) {
                if (is_numeric($log->visits)) {
                    $average += $log->visits;
                }
            }
            $average = $average / $website->websiteLogs->count();

            return $average;
        }

        return 0;
    }

    public static function averageLatestThreeMonths(Organization $organization)
    {
        $website = $organization->websites()->first();

        if ($website && count($website->websiteLogs) > 0) {
            $logs = $website->websiteLogs()->orderBy('year', 'DESC')->orderBy('month', 'DESC')->take(3)->get();

            $average = 0;
            foreach ($logs as $log) {
                if (is_numeric($log->visits)) {
                    $average += $log->visits;
                }
            }
            $average = $average / $logs->count();

            return $average;
        }

        return 0;
    }
}
