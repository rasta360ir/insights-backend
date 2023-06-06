<?php

namespace Database\Seeders;

use App\Models\ApplicationLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicationLogs = DB::connection('mysql2')
            ->select("SELECT * FROM app_logs ORDER BY id ASC");

        foreach ($applicationLogs as $applicationLog) {
            ApplicationLog::query()->create([
                'id' => $applicationLog->id,
                'application_id' => $applicationLog->application_id,
                'downloads' => $applicationLog->downloads,
                'rate' => $applicationLog->rate,
                'votes' => $applicationLog->votes,
                'version' => $applicationLog->version,
                'registered_at' => $applicationLog->logged_at,
                'created_at' => $applicationLog->created_at,
                'updated_at' => $applicationLog->updated_at,
            ]);
        }
    }
}
