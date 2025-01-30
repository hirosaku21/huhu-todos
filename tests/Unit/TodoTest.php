<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

class TodoTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_ログイン画面以外にアクセスするとログイン画面にリダイレクトされる(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_ログイン認証してTOP画面表示(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        if ($response->status() === 500) {
            $this->fail($response->getMessage());
        }
        $response->assertStatus(200);
    }

    public function test_ユーザーが登録されてるか(): void
    {
        $response = $this->assertDatabaseCount('users', 2);
    }
}
