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
            UserSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,

            CategorySeeder::class,
            OrganizationSeeder::class,
            CategoryOrganizationSeeder::class,
            WebsiteSeeder::class,
            WebsiteLogSeeder::class,
            ApplicationSeeder::class,
            ApplicationLogSeeder::class,
            SocialNetworkSeeder::class,

            NewsSeeder::class,
            TagSeeder::class,
            TaggableSeeder::class,

            DepartmentSeeder::class,
            JobSeeder::class,
            PersonSeeder::class,

            ContactFormSeeder::class,
            UserOrganizationVisitsSeeder::class,

            FAQSeeder::class,
            SubscriptionPlanSeeder::class,
        ]);
    }
}
