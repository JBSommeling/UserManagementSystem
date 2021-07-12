<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin
        DB::table('users')->insert([
            'name' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@example.com',
            'question' => 'password',
            'answer' => 'password',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()
                ->count(10)
                ->create();
    }
}
