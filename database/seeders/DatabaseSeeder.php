<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CountriesTableSeeder::class,
            GameCategorySeeder::class,
            GamesTableSeeder::class,
            UsersTableSeeder::class,
            PaymentListSeeder::class,
            LanguageSeeder::class,
            ManagersTableSeeder::class
        ]);
    }
}
