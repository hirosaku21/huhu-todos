<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoFeatureTest extends TestCase
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

    public function test_認証済みユーザーがTodo一覧を表示できる(): void
    {
        $response = $this->actingAs($this->user)->get(route('todos.index'));
        $response->assertStatus(200);
    }

    public function test_未認証ユーザーはTodo一覧にアクセスできない(): void
    {
        $response = $this->get(route('todos.index'));
        $response->assertRedirect('/login');
    }

    public function test_認証済みユーザーが新規Todoを作成できる(): void
    {
        $todoData = [
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
        ];

        $response = $this->actingAs($this->user)
            ->post(route('todos.store'), $todoData);

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', [
            'content' => 'テストタスク',
            'registered_by' => $this->user->id,
        ]);
    }

    public function test_認証済みユーザーがTodoを完了できる(): void
    {
        $todo = Todo::create([
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
            'registered_by' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->put(route('todos.complete', ['todoId' => $todo->id]));

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'completed' => 1,
            'completed_by' => $this->user->id,
        ]);
    }

    public function test_認証済みユーザーがTodoを削除できる(): void
    {
        $todo = Todo::create([
            'content' => 'テストタスク',
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
            'registered_by' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('todos.destroy', ['todoId' => $todo->id]));

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }

    public function test_バリデーションエラーの場合は作成できない(): void
    {
        $todoData = [
            'content' => str_repeat('a', 101), // 100文字制限を超える
            'category_id' => $this->category->id,
            'sharing_range' => 'share',
        ];

        $response = $this->actingAs($this->user)
            ->post(route('todos.store'), $todoData);

        $response->assertSessionHasErrors(['content']);
    }
} 