<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\PostVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        // verify
        
    	Post::create([
    		'content' => request('content'),
    		'category_id' => request('category'),
    		'original' => request('original'),
            'user_id' => Auth::user()->id
    	]);

    	return redirect('submit');
    }

    public function view($id)
    {
        $post = Post::with('category', 'user')->find($id);
        $comments = Comment::with('user')->where('post_id', $post->id)->get();

        return view('pages.view', compact('post', 'comments'));
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('pages.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->content = request('content');
        if(request('original'))
            $post->original = 1;
        else
            $post->original = null;

        $post->save();

        return redirect('v/' . $post->id);
        // return view('pages.view', compact('post'));
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect('/');
    }

    public function vote(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $post = Post::find($id);

        if ($type === 'upvote')
            $vote = 1;
        elseif ($type === 'downvote')
            $vote = -1;

        // ako korisnik nije glasao - upisi u tabelu
        if (!$post->votedBy($request->user())->count() > 0) {
            $request->user()->postVote()->attach($id, ['vote' => $vote]);
            if ($vote === 1)
                $post->increment('upvotes');
            else
                $post->increment('downvotes');
            return response()->json('Vas glas je upisan');
        }

        // ako korisnik zeli da obrise svoj vote (vote === $vote) - obrisi red iz tabele
        if ($post->votedBy($request->user())->first() === $vote) {
            $request->user()->postVote()->detach($id);
            if ($vote === 1)
                $post->decrement('upvotes');
            else
                $post->decrement('downvotes');
        }
        // ako korisnik promijeni vote (vote !== $vote) - update-uj vote
        elseif ($post->votedBy($request->user())->first() !== $vote) {
            $request->user()->postVote()->updateExistingPivot($id, ['vote' => $vote]);
            if ($vote === 1) {
                $post->decrement('downvotes');
                $post->increment('upvotes');
            }
            else {
                $post->decrement('upvotes');
                $post->increment('downvotes');
            }
        }

        return response()->json('Vas glas je promijenjen');
    }

    public function favorite(Request $request)
    {
        $id = $request->input('id');

        $request->user()->favoritePosts()->toggle($id);

        // dodati +1 ili *1 u post->favorites

        return response()->json('Success!');
    }
}
