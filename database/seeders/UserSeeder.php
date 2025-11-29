<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '123456789',
        ]);
        User::create([
            'name' => 'ahmed',
            'email' => 'ahmed@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '1234567810',
        ]);
        DB::table('users')->insert([
            'name' => 'farag',
            'email' => 'farag@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '1234567811',
        ]);
    }
}
