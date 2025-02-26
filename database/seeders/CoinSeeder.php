<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coin;


class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coins = [
            ['type' => 'mobile', 'value' => 1],
            ['type' => 'PS5', 'value' => 2],
            ['type' => 'laptop', 'value' => 3],
            ['type' => 'tv', 'value' => 4],
            ['type' => 'bicycle', 'value' => 5],
            ['type' => 'car', 'value' => 6],
        ];

        foreach ($coins as $coin) {
            Coin::create($coin);
        }
    }
}
