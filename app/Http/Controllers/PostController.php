<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {
        // verify
        
    	Post::create([
    		'content' => request('content'),
    		'category' => request('category'),
    		'original' => request('original'),
            'user_id' => Auth::user()->id
    	]);

    	return redirect('submit');
    }

    public function view($id)
    {
        $post = Post::find($id);

        return view('pages.view', compact('post'));
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
}
