<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = DB::connection('mysql2')
            ->select("SELECT * FROM people ORDER BY id ASC");

        foreach ($people as $person) {
            Person::query()->create([
                'id' => $person->id,
                'first_name' => $person->first_name,
                'last_name' => $person->last_name,
                'job_id' => $person->job_id,
                'organization_id' => $person->organization_id,
                'email' => $person->email,
                'linkedin' => $person->linkedin,
                'phone' => $person->phone,
                'gender' => $person->gender,
                'title' => $person->title,
                'comment' => $person->comment,
                'deleted_at' => $person->deleted_at,
                'created_at' => $person->created_at,
                'updated_at' => $person->updated_at,
            ]);
        }
    }
}
