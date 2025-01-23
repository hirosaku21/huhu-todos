<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Todo;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function todos()
    {
        $completedTodos = Todo::where('completed', 1)
            ->where('sharing_range', 'share')
            ->with(['completed_by'])
            ->get()
            ->groupBy('completed_by')
            ->toArray();
            // dd($completedTodos);
        return view('admin.todos', ['completedTodos' => $completedTodos]);
    }

    public function categoriesIndex()
    {
        $categories = Category::get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function categoriesCreate()
    {
        return view('admin.categories.create');
    }

    public function categoriesStore(StoreCategoryRequest $request)
    {

        $validated = $request->validated();
        Category::create($validated);

        return redirect()->route('admin.categories.index');
    }
}
