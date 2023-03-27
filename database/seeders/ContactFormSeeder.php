<?php

namespace Database\Seeders;

use App\Models\ContactForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactForms = DB::connection('mysql2')
            ->select("SELECT * FROM contact_forms ORDER BY id ASC");

        foreach ($contactForms as $contactForm) {
            ContactForm::query()->create([
                'id' => $contactForm->id,
                'name' => $contactForm->name,
                'email' => $contactForm->email,
                'phone' => $contactForm->phone,
                'message' => $contactForm->message,
                'created_at' => $contactForm->created_at,
                'updated_at' => $contactForm->updated_at,
            ]);
        }
    }
}
