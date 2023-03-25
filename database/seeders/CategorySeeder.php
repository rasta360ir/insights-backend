<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::connection('mysql2')
            ->select("SELECT * FROM categories ORDER BY id ASC");

        foreach ($categories as $category) {
            Category::query()->create([
                'id' => $category->id,
                'title' => $category->title,
                'slug' => $category->slug,
                'parent_id' => $category->parent_id,
                'body' => $category->body,
                'deleted_at' => $category->deleted_at,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ]);
        }
    }
}
