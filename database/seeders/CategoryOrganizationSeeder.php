<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = DB::connection('mysql2')->select("SELECT * FROM category_organization ORDER BY organization_id ASC");

        foreach ($records as $record) {
            DB::table('category_organization')->insert([
                'category_id' => $record->category_id,
                'organization_id' => $record->organization_id,
            ]);
        }
    }
}
