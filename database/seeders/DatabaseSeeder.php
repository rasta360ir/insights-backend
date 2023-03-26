<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,

            CategorySeeder::class,
            OrganizationSeeder::class,
            CategoryOrganizationSeeder::class,
            WebsiteSeeder::class,
            ApplicationSeeder::class,
            SocialNetworkSeeder::class,

            NewsSeeder::class,

            DepartmentSeeder::class,
            JobSeeder::class,
        ]);
    }
}
