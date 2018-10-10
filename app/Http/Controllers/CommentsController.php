<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,[
            'message' => 'required'
        ]);

        $comment = new Comment();
        $text = $comment->text = $request->get('message');
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->get('post_id');
        $comment->save();

        //return redirect()->back()->with('status','Комментарий ожидает проверки администратора!');
        return response()->json([
            'text' => $text,
            'name' => Auth::user()->name,
            'img' => Auth::user()->avatar,
            'date' => $comment->created_at->diffForHumans()
        ]);

    }
}
