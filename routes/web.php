<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::middleware('auth')->name('todos.')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::get('/personal', [TodoController::class, 'personal'])->name('personal');
    Route::get('/create', [TodoController::class, 'create'])->name('create');
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::delete('/destroy/{todoId}', [TodoController::class, 'destroy'])->name('destroy');
    Route::put('/update/{todoId}', [TodoController::class, 'update'])->name('update');
    Route::put('/complete/{todoId}', [TodoController::class, 'complete'])->name('complete');
});

Route::middleware('auth', 'admin')->name('admin.')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('index');
    Route::get('/admin/todos', [AdminController::class, 'todos'])->name('todos');
    Route::get('/admin/categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
    Route::get('/admin/categories/create', [AdminController::class, 'categoriesCreate'])->name('categories.create');
    Route::post('/admin/categories/store', [AdminController::class, 'categoriesStore'])->name('categories.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
