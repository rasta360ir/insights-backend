<?php

namespace App\Services\Insights;

use App\Models\Organization;

class ApplicationService
{
    public static function cafebazarApp(Organization $organization)
    {
        $application = $organization->applications()->where('platform', 'cafebazar')->first();

        if ($application) {
            return $application->applicationLogs()->first();
        }

        return null;
    }

    public static function googleplayApp(Organization $organization)
    {
        $application = $organization->applications()->where('platform', 'googleplay')->first();

        if ($application) {
            return $application->applicationLogs()->first();
        }

        return null;
    }
}
