<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {
        //verifikacija

    	Post::create([
    		'content' => request('content') ,
    		'category' => request('category'),
    		'original' => request('original'),
            'user_id' => Auth::user()->id
    	]);

    	return redirect('submit');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->back();
    }
}
