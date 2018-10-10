<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {

        $comments = Comment::all();
        return view('admin.comment.index', compact('comments'));
    }

    public function destroy($id)
    {
        Comment::find($id)->remove();

       return redirect()->back();
    }
}
