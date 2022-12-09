<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;


Route::apiResource('todo-list', TodoListController::class);

// Route::prefix('todo-list')->group(function () {
//   Route::get('', [TodoListController::class, 'index'])->name('todo-list.index');
//   Route::get('/{list}', [TodoListController::class, 'show'])->name('todo-list.show');
//   Route::post('', [TodoListController::class, 'store'])->name('todo-list.store');
//   Route::delete('/{list}', [TodoListController::class, 'destroy'])->name('todo-list.destroy');
//   Route::patch('/{list}', [TodoListController::class, 'update'])->name('todo-list.update');
// });
