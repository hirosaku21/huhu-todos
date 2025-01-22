<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        return view('todos.index');
    }

    public function create()
    {
        $categories = Category::all();
        $todos = Todo::all();
        return view('todos.create', ['categories' => $categories, 'todos' => $todos]);
    }

    public function store(StoreTodoRequest $request)
    {
        $validated = $request->validated();
        $validated['registered_by'] = Auth::id();
        Todo::create($validated);

        return redirect()->route('todos.index');
    }
}
