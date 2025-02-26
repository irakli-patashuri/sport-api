<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
  // Create a few example users
        User::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'gender' => 'male',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('password123'), // Always hash the password
            'mobile' => '1234567890',
            'birthday' => '1990-01-01',
            'country_id' => 1, // Assuming 1 corresponds to a valid country
            'address' => '123 Example Street',
            'city' => 'Example City',
            'balance' => 100.00, // Initial balance
            'last_login' => now(),
            'last_login_ip' => '127.0.0.1',
            'email_verified_at' => now(),
            'mobile_verified_at' => now(),
            'google_2fa' => 0, // Disable 2FA initially
            'sms_2fa' => 0, // Disable SMS 2FA initially
            'status' => 1, // Active status
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
