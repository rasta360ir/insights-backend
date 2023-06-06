<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taggables = DB::connection('mysql2')
            ->select("SELECT * FROM taggables ORDER BY taggable_id ASC");

        foreach ($taggables as $taggable) {
            DB::table('taggables')->insert([
                'tag_id' => $taggable->tag_id,
                'taggable_id' => $taggable->taggable_id,
                'taggable_type' => $taggable->taggable_type,
            ]);
        }
    }
}
