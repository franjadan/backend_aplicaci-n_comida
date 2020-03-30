<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
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

    public function new(Request $request)
    {
        $rules = [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'comment' => ['required'],
        ];

        $messages = [
            'user_id.required' => 'El comentario debe ser redactado por un usuario',
            'user_id.exists' => 'El comentario debe ser redactado por un usuario registrado',
            'comment.required' => 'El cmapo comentario debe ser obligatorio',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['response' => ['code' => -1, 'data' => $validator->errors()]], 400);
        }else {
            Comment::create([
                'user_id' => $request->get('user_id'),
                'comment' => $request->get('comment'),
            ]);

            return response()->json(['response' => ['code' => 1, 'data' => 'El comentario se ha guardado con éxito']], 201);
        }
    }
}
