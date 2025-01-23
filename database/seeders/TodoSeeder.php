<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::factory()->createMany([
            [
                'content' => '共有タスク1',
                'category_id' => 1,
                'sharing_range' => 'share',
                'registered_by' => 1
            ],
            [
                'content' => '共有タスク2',
                'category_id' => 2,
                'sharing_range' => 'share',
                'registered_by' => 1
            ],
            [
                'content' => '共有タスク3',
                'category_id' => 2,
                'sharing_range' => 'share',
                'registered_by' => 1
            ],
            [
                'content' => '共有タスク4',
                'category_id' => 2,
                'sharing_range' => 'share',
                'registered_by' => 1
            ],
            [
                'content' => '個人タスク1',
                'category_id' => 1,
                'sharing_range' => 'personal',
                'registered_by' => 1
            ],
            [
                'content' => '個人タスク2',
                'category_id' => 2,
                'sharing_range' => 'personal',
                'registered_by' => 1
            ],
            [
                'content' => '個人タスク3',
                'category_id' => 1,
                'sharing_range' => 'personal',
                'registered_by' => 1
            ],
        ]);
    }
}
