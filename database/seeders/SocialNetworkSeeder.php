<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialNetworks = DB::connection('mysql2')
            ->select("SELECT * FROM social_networks ORDER BY id ASC");

        foreach ($socialNetworks as $socialNetwork) {
            SocialNetwork::query()->create([
                'id' => $socialNetwork->id,
                'organization_id' => $socialNetwork->organization_id,
                'platform' => $socialNetwork->platform,
                'url' => $socialNetwork->url,
                'deleted_at' => $socialNetwork->deleted_at,
                'created_at' => $socialNetwork->created_at,
                'updated_at' => $socialNetwork->updated_at,
            ]);
        }
    }
}
