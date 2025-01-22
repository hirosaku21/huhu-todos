<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->createMany([
            [
                'name' => 'ひろ',
                'email' => 'hiroyuki_scorpio3@hotmail.co.jp',
                'password' => 'test',
                'role' => 'admin'
            ],
            [
                'name' => 'めぐ',
                'email' => 'mimi6oto33@gmail.com',
                'password' => 'test',
                'role' => 'user'
            ]
        ]);
    }
}
