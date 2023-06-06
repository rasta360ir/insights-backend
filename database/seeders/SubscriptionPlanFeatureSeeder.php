<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $basicPlanFeatures = [
            [
                'feature' => 'مشاهده محدود پروفایل کسب و کارها',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده محدود اطلاعات افراد در هر پروفایل',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده محدود اطلاعات رقبا در هر پروفایل',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده محدود در هر جست و جوی پیشرفته',
                'status' => true,
            ],
            [
                'feature' => 'دریافت خروجی اکسل',
                'status' => false,
            ],
        ];

        $professionalPlanFeatures = [
            [
                'feature' => 'مشاهده نامحدود پروفایل کسب و کارها',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده نامحدود اطلاعات افراد در هر پروفایل',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده نامحدود اطلاعات رقبا در هر پروفایل',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده محدود در هر جست و جوی پیشرفته',
                'status' => true,
            ],
            [
                'feature' => 'دریافت ماهانه 250 سطر خروجی اکسل',
                'status' => true,
            ],
        ];

        $organizationalPlanFeatures = [
            [
                'feature' => 'مشاهده نامحدود پروفایل کسب و کارها',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده نامحدود اطلاعات افراد در هر پروفایل',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده نامحدود اطلاعات رقبا در هر پروفایل',
                'status' => true,
            ],
            [
                'feature' => 'مشاهده نامحدود در هر جست و جوی پیشرفته',
                'status' => true,
            ],
            [
                'feature' => 'دریافت ماهانه نامحدود خروجی اکسل',
                'status' => true,
            ],
            [
                'feature' => 'گزارش های فصلی از روندها و اتفاقات اکوسیستم استارتاپی ایران',
                'status' => true,
            ],
        ];

        $basicPlan = SubscriptionPlan::query()
            ->where('slug', 'basic')->first();
        $basicPlan->features()->createMany($basicPlanFeatures);

        $professionalPlan = SubscriptionPlan::query()
            ->where('slug', 'professional')->first();
        $professionalPlan->features()->createMany($professionalPlanFeatures);

        $organizationalPlan = SubscriptionPlan::query()
            ->where('slug', 'organizational')->first();
        $organizationalPlan->features()->createMany($organizationalPlanFeatures);

    }
}
