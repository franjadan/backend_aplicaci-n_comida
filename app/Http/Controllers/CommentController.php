<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use DataTables;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::query()
        ->orderBy('created_at')
        ->get();

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

    public function comments()
    {
        $comments = Comment::all();

        return response()->json(['response' => ['code' => 1, 'data' => CommentResource::collection($comments)]]);
    }
}
