<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = DB::connection("mysql2")
            ->select("SELECT * FROM jobs ORDER BY id ASC");

        foreach ($jobs as $job) {
            Job::query()->create([
                'id' => $job->id,
                'title' => $job->title,
                'department_id' => $job->department_id,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
            ]);
        }
    }
}
