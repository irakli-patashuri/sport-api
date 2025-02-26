<?php

namespace Database\Seeders; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameCategorySeeder extends Seeder
{

    public function run()
    {
        $gameIds = [12166, 12167, 12168, 12169, 12170, 12199, 12256, 12257, 12258, 12259];
        DB::table('game_categories')->insert([
            'games' => json_encode($gameIds),
            'category_id' => 2,
            'status' => 1,
            'name' => 'popular',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
