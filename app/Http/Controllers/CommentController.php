<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;

class CommentController extends Controller
{
    public function index($taskId)
    {
        $task = Task::with('comments')->findOrFail($taskId);

        return view('tasks.show', ['task' => $task]);
    }

    public function store(Request $request, $taskId)
    {
        $request->validate([
            'comentario' => 'required',
        ]);

        $comment = new Comment;
        $comment->comentario = $request->comentario;
        $comment->task_id = $taskId;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('tasks.show', $taskId)->with('msg', 'Comentário adicionado com sucesso!');
    }

    public function destroy($taskId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return redirect()->route('tasks.show', $taskId)->with('msg', 'Comentário excluído com sucesso!');
    }

    public function edit($taskId, $commentId)
    {
        $task = Task::with('comments')->findOrFail($taskId);

        $editingComment = Comment::findOrFail($commentId);

        return view('tasks.show', compact('task', 'editingComment'));
    }

    public function update(Request $request, $taskId, $commentId)
    {
        $request->validate([
            'comentario' => 'required',
        ]);

        $comment = Comment::findOrFail($commentId);
        $comment->comentario = $request->comentario;
        $comment->save();

        return redirect()->route('tasks.show', $taskId)->with('msg', 'Comentário atualizado com sucesso!');
    }
}
