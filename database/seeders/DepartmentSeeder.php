<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = DB::connection("mysql2")
            ->select("SELECT * FROM departments ORDER BY id ASC");

        foreach ($departments as $department) {
            Department::create([
                'id' => $department->id,
                'title' => $department->title,
                'created_at' => $department->created_at,
                'updated_at' => $department->updated_at,
            ]);
        }
    }
}
