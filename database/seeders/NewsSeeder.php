<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = DB::connection('mysql2')
            ->select("SELECT * FROM news ORDER BY id ASC");

        foreach ($news as $item) {
            News::query()->create([
                'id' => $item->id,
                'title' => $item->title,
                'url' => $item->url,
                'source' => $item->reference,
                'registered_at' => $item->registered_at,
                'deleted_at' => $item->deleted_at,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }
}
