<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Todo;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        // テストユーザーとカテゴリーを作成
        $this->user = User::factory()->create(['role' => 'user']);
        $this->category = Category::factory()->create(['name' => 'テストカテゴリー']);
    }

    public function test_todoを作成できる(): void
    {
        $todo = Todo::create([
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
            'registered_by' => $this->user->id,
        ]);

        $this->assertDatabaseHas('todos', [
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
        ]);
    }

    public function test_todoを完了できる(): void
    {
        $todo = Todo::create([
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
            'registered_by' => $this->user->id,
        ]);

        $todo->update([
            'completed' => 1,
            'completed_by' => $this->user->id,
            'completed_at' => now()
        ]);

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'completed' => 1,
            'completed_by' => $this->user->id,
        ]);
    }

    public function test_todoを削除できる(): void
    {
        $todo = Todo::create([
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
            'registered_by' => $this->user->id,
        ]);

        $todo->delete();

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }

    public function test_todoのリレーション(): void
    {
        $todo = Todo::create([
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
            'registered_by' => $this->user->id,
        ]);

        $todo = Todo::with(['category', 'registered_by'])->find($todo->id);

        $this->assertInstanceOf(Category::class, $todo->category);
        $this->assertInstanceOf(User::class, $todo->registered_by_user);
    }
}
