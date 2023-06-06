<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = DB::connection('mysql2')
            ->select("SELECT * FROM websites ORDER BY id ASC");

        foreach ($websites as $website) {
            Website::query()->create([
                'id' => $website->id,
                'organization_id' => $website->organization_id,
                'url' => $website->url,
                'deleted_at' => $website->deleted_at,
                'created_at' => $website->created_at,
                'updated_at' => $website->updated_at,
            ]);
        }
    }
}
