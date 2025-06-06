<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::get('/', [TaskController::class, 'index']);
Route::get('/tasks/create', [TaskController::class, 'create'])->middleware('auth');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::post('/tasks', [TaskController::class, 'store']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware('auth');
Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->middleware('auth');
Route::put('/tasks/update/{id}', [TaskController::class, 'update'])->middleware('auth');
Route::post('tasks/{taskId}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/tasks/{taskId}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

// Rota para exibir o formulário de edição de um comentário específico
Route::get('/tasks/{taskId}/comments/{commentId}/edit', [CommentController::class, 'edit'])
    ->name('comments.edit')
    ->middleware('auth');

// Rota para atualizar um comentário específico (após submeter o formulário de edição)
Route::put('/tasks/{taskId}/comments/{commentId}', [CommentController::class, 'update'])
    ->name('comments.update')
    ->middleware('auth');

// Rota para deletar um comentário específico
Route::delete('/tasks/{taskId}/comments/{commentId}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
});