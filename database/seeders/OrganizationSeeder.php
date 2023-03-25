<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get organizations from previous database table
        $organizations = DB::connection('mysql2')
            ->select('SELECT * FROM organizations ORDER BY id ASC');

        // Insert with same id into new database table
        foreach ($organizations as $organization) {

            // Check for new city ids that have changed in latest project version
            $cityId = null;
            if (!is_null($organization->city_id)) {
                $cityName = DB::connection('mysql2')
                    ->select("SELECT name FROM cities WHERE id = {$organization->city_id}")[0]->name;
                $cityId = City::query()->where('name', 'LIKE', trim($cityName))->first()->id ?? NULL;
            }

            Organization::create([
                'id' => $organization->id,
                'title' => $organization->title,
                'slug' => $organization->slug,
                'legal_title' => $organization->legal_title,
                'known_as' => $organization->known_as,
                'parent_id' => $organization->parent_id,
                'status' => $organization->status,
                'type' => $organization->type,
                'profile_type' => $organization->profile_type,
                'ownership_type' => $organization->ownership_type,
                'business_model' => $organization->business_model,
                'ipo' => $organization->ipo,
                'num_employees' => $organization->num_employees,
                'description' => $organization->description,
                'body' => $organization->body,
                'phone' => $organization->phone,
                'email' => $organization->email,
                'province_id' => $organization->province_id,
                'city_id' => $cityId,
                'primary_address' => $organization->primary_address,
                'secondary_address' => $organization->secondary_address,
                'founded_year' => $organization->founded_year,
                'founded_month' => $organization->founded_month,
                'founded_day' => $organization->founded_day,
                'registered_year' => $organization->registered_year,
                'registered_month' => $organization->registered_month,
                'registered_day' => $organization->registered_day,
                'closed_year' => $organization->closed_year,
                'closed_month' => $organization->closed_month,
                'closed_day' => $organization->closed_day,
                'imageUrl' => $organization->image_url,
                'created_at' => $organization->created_at,
                'updated_at' => $organization->updated_at,
            ]);
        }
    }
}
