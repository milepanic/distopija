<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3|alpha_num',
        ]);

    	$category = Category::create([
    		'name'        => $request->name,
    		'nsfw'        => $request->nsfw,
    		'cover_box'   => $request->cover_box,
    		'pictures'    => $request->pictures,
    		'videos'      => $request->videos,
            'mods_only'   => $request->mods_only
    	]);

        $user = $request->user();

        $category->users()->attach($user->id, ['moderator' => true]);        

    	return redirect('create');
    }

    public function view($name)
    {
        $category   = Category::where('name', $name)->first();
        $posts      = Post::where('category_id', $category->id)->paginate(10);
        $user       = Auth::user();

        return view('pages.category', compact('category', 'posts', 'user'));
    }

    public function block($id)
    {
        $user       = Auth::id();
        $category   = Category::find($id);

        $category->users()->attach($user, ['blocked' => true]);

        return redirect('/');        
    }
    // NAPRAVITI TOGGLE UMJESTO ATTACH DETACH
    public function unblock($id)
    {
        $user       = Auth::id();
        $category   = Category::find($id);

        $category->users()->toggle($user);

        return back();        
    }

    public function approve($id)
    {
        $category = Category::find($id);

        $category->approved = true;

        $category->save();

        return redirect()->back();
    }

    public function reject($id)
    {
        $category = Category::find($id);

        $category->approved = false;

        $category->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        Category::destroy($id);
        
        return redirect()->back();
    }
}
