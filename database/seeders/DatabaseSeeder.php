<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'ひろ',
            'email' => 'hiroyuki_scorpio3@hotmail.co.jp',
            'password' => 'test',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'めぐ',
            'email' => 'mimi6oto33@gmail.com',
            'password' => 'test',
            'role' => 'user'
        ]);
    }
}
