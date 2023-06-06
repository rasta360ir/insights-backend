<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applications = DB::connection('mysql2')
            ->select("SELECT * FROM applications ORDER BY id ASC");

        foreach ($applications as $application) {
            Application::query()->create([
                'id' => $application->id,
                'organization_id' => $application->organization_id,
                'platform' => $application->platform,
                'url' => $application->url,
                'deleted_at' => $application->deleted_at,
                'created_at' => $application->created_at,
                'updated_at' => $application->updated_at,
            ]);
        }
    }
}
