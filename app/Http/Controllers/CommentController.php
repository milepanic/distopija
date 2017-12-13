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
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

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

    public function edit(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);
        
        $comment = Comment::find($id);

        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($request->comment);
    }
    
    public function delete($id)
    {
        Comment::destroy($id);

        return response()->json('Comment has been deleted');
    }
}
