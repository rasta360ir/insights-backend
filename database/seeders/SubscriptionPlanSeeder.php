<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptionPlans = [
            [
                'title' => 'پایه',
                'slug' => 'basic',
                'monthly_price' => 0,
                'yearly_price' => 0,
            ],
            [
                'title' => 'حرفه‌ای',
                'slug' => 'professional',
                'monthly_price' => 150_000,
                'yearly_price' => 1_800_000,
            ],
            [
                'title' => 'سازمانی',
                'slug' => 'organizational',
                'monthly_price' => 750_000,
                'yearly_price' => 9_000_000,
                'featured' => 1,
            ],
        ];

        foreach ($subscriptionPlans as $subscriptionPlan) {
            SubscriptionPlan::query()->create($subscriptionPlan);
        }
    }
}
