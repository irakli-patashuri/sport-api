<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('payment_list')->insert([
            'name' => 'skypay_crypto',
            'logo' => 'skypay_crypto.png',
            'type' => 'deposit',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('payment_list')->insert([
            'name' => 'skypay_fiat',
            'logo' => 'skypay_fiat.png',
            'type' => 'deposit',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('payment_list')->insert([
            'name' => 'nonstop_pay',
            'logo' => 'nonstop_pay.png',
            'type' => 'deposit',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('payment_list')->insert([
            'name' => 'skypay_crypto',
            'logo' => 'skypay_crypto.png',
            'type' => 'withdraw',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('payment_list')->insert([
            'name' => 'skypay_fiat',
            'logo' => 'skypay_fiat.png',
            'type' => 'withdraw',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
