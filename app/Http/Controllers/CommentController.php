<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::query()
        ->orderBy('created_at')
        ->paginate();

        return view('comments.index', [
            'comments' => $comments,
        ]);
    }

    public function show(Comment $comment)
    {
        return view('comments.show', [
            'comment' => $comment,
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments')->with('success', 'Se ha eliminado con éxito.');
    }
}
