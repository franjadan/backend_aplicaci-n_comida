<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use DataTables;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::all();

        if ($request->ajax()) {
            return Datatables::of($comments)
                ->addColumn('comment', function($row) {
                    return "<td>". substr($row->comment, 0, 30) ."...</td>";
                })
                ->addColumn('actions', function($row){
                        $actions = "<form action='". route('comments.destroy', $row) . "' method='POST'>" .csrf_field() . "" . method_field('DELETE') . "<a class='btn btn-primary mr-1' href='" . route('comments.show', ['comment' => $row]) . "'><i class='fas fa-eye'></i></a><button class='btn btn-danger' type='submit'><i class='fas fa-trash-alt'></i></button></form>";
                        return $actions;
                })
                ->rawColumns(['comment', 'actions'])
                ->make(true);
        }

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
