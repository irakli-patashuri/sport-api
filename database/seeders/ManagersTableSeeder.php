<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            [
                'name' => 'Amiran afciauri',
                'email' => 'Ako.afcika@gmail.com',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'irakli patashuri',
                'email' => 'irakli@emails.ge',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'dimitiri xetaguri',
                'email' => 'dimitri.xetaguri.96@gmail.com',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
