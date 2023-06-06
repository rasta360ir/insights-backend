<?php

namespace Database\Seeders;

use App\Models\WebsiteLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websiteLogs = DB::connection('mysql2')
            ->select("SELECT * FROM website_logs ORDER BY id ASC");

        foreach ($websiteLogs as $websiteLog) {
            WebsiteLog::query()->create([
                'id' => $websiteLog->id,
                'website_id' => $websiteLog->website_id,
                'visits' => (int) $websiteLog->visits,
                'year' => $websiteLog->year,
                'month' => $websiteLog->month,
                'created_at' => $websiteLog->created_at,
                'updated_at' => $websiteLog->updated_at,
            ]);
        }
    }
}
