<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::where([
            'completed' => 0,
            'sharing_range' => 'share'
        ])->get();
        return view('todos.index', ['todos' => $todos, 'user' => $user]);
    }

    public function personal()
    {
        $user = Auth::user();
        $todos = Todo::where([
            'completed' => 0,
            'sharing_range' => 'personal',
            'registered_by' => Auth::id()
        ])->get();
        return view('todos.personal', ['todos' => $todos, 'user' => $user]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('todos.create', ['categories' => $categories]);
    }

    public function store(StoreTodoRequest $request)
    {
        $validated = $request->validated();
        $validated['registered_by'] = Auth::id();
        Todo::create($validated);

        return redirect()->route('todos.index');
    }

    public function destroy(int $todoId)
    {
        $todo = Todo::findOrFail($todoId);
        $todo->delete();
        return redirect()->route('todos.index');
    }

    public function update(Request $request, int $todoId)
    {
        $todo = Todo::findOrFail($todoId);

        if (!$request->content) {
            $todo->delete();
        } else {
            $validated = $request->validate([
                'content' => 'max:100'
            ]);
            $todo->update($validated);
        }

        return redirect()->route('todos.index');
    }

    public function complete(Request $request, int $todoId)
    {
        $todo = Todo::findOrFail($todoId);
        $todo->update([
            'completed' => 1,
            'completed_by' => Auth::id(),
            'completed_at' => now()
        ]);
        return redirect()->route('todos.index');
    }
}
