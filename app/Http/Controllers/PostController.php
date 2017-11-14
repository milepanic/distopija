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
        $user = Auth::user()->id;

        if ($type === 'upvote')
            $data = 1;
        elseif ($type === 'downvote')
            $data = 0;

        PostVote::create([
            'post_id' => $id,
            'user_id' => $user,
            'vote' => $data
        ]);
    }

    public function favorite(Request $request)
    {
        $id = $request->input('id');

        $request->user()->favoritePosts()->toggle($id);

        return response()->json('Succes!');
    }
}
