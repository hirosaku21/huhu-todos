<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TodoTest extends DuskTestCase
{
    use DatabaseMigrations;

    private User $user;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        // テストユーザーとカテゴリーを作成
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
        $this->category = Category::factory()->create(['name' => 'テストカテゴリー']);
    }

    public function test_ログインしてTodoを作成して完了までの流れ(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                   ->type('email', 'test@example.com')
                   ->type('password', 'password')
                   ->press('ログイン')
                   ->assertPathIs('/')
                   ->clickLink('新規作成')
                   ->assertPathIs('/create')
                   ->type('content', 'テストタスク')
                   ->select('category_id', $this->category->id)
                   ->radio('sharing_range', 'share')
                   ->press('作成')
                   ->assertPathIs('/')
                   ->assertSee('テストタスク')
                   ->press('完了')
                   ->assertDontSee('テストタスク');
        });
    }

    public function test_Todoの作成時のバリデーション(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                   ->type('email', 'test@example.com')
                   ->type('password', 'password')
                   ->press('ログイン')
                   ->clickLink('新規作成')
                   ->press('作成')
                   ->assertSee('タスクを入力してください')
                   ->assertSee('カテゴリーを選択してください')
                   ->assertSee('共有範囲を選択してください');
        });
    }

    public function test_個人タスクの作成と表示(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                   ->type('email', 'test@example.com')
                   ->type('password', 'password')
                   ->press('ログイン')
                   ->clickLink('新規作成')
                   ->type('content', '個人タスク')
                   ->select('category_id', $this->category->id)
                   ->radio('sharing_range', 'personal')
                   ->press('作成')
                   ->clickLink('個人タスク一覧')
                   ->assertSee('個人タスク');
        });
    }
} 