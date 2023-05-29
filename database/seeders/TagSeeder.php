<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = DB::connection('mysql2')
            ->select("SELECT * FROM tags ORDER BY id ASC");

        foreach ($tags as $tag) {
            Tag::query()->create([
                'id' => $tag->id,
                'title' => $tag->title,
                'slug' => $tag->slug,
                'created_at' => $tag->created_at,
                'updated_at' => $tag->updated_at,
            ]);
        }
    }
}
