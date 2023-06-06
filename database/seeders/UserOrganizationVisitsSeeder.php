<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserOrganizationVisitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = DB::connection('mysql2')
            ->select("SELECT * FROM user_organization_visits ORDER BY id ASC");

        foreach ($records as $record) {
            $organization = Organization::query()
                ->find($record->organization_id);
            $user = User::query()
                ->find($record->user_id);

            if (!is_null($organization)) {
                DB::table('user_organization_visits')->insert([
                    'id' => $record->id,
                    'organization_id' => $organization->id ?? null,
                    'user_id' => $user->id ?? null,
                    'created_at' => $record->created_at,
                    'updated_at' => $record->updated_at,
                ]);
            }
        }
    }
}
