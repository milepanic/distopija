<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentVote;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request, $id)
    {
        // validate

        Comment::create([
            'comment' => $request->comment,
            'post_id' => $id,
            'user_id' => Auth::id()
        ]);

    	return redirect()->back();
    }

    public function update(Request $request, $id, $type)
    {
        $comment = Comment::find($id);

        $vote = $comment->votes;

        if($type === "up")
            $vote++;
        elseif($type === "down")
            $vote--;
        else
            abort(403, 'Unauthorized action');
            
        $comment->votes = $vote;
        $comment->save();

        CommentVote::create([
            'comment_id' => $id,
            'user_id' => Auth::user()->id,
            'vote' => $type
        ]);

        return redirect()->back();
    }
    
}
