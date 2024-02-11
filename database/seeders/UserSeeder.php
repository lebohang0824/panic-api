<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'              => 'Commissioner Gordon',
            'email'             => 'gordon@gothampd.com',
            'email_verified_at' => now()->add('min', 10),
            'password'          => Hash::make('BettleJuice'),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
