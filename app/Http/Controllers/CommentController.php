<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request, $id)
    {
        // verify

        Comment::create([
            'comment' => request('comment'),
            'post_id' => $id,
            'user_id' => Auth::user()->id
        ]);

    	return redirect()->back();
    }

    public function read($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();
        dd($comments);
    }
}
