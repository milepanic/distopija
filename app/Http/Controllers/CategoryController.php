<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3|alpha_num',
        ]);

    	Category::create([
    		'name'        => $request->name,
    		'nsfw'        => $request->nsfw,
    		'cover_box'   => $request->cover_box,
    		'pictures'    => $request->pictures,
    		'videos'      => $request->videos,
            'mods_only'   => $request->mods_only
    	]);

    	return redirect('create');
    }

    public function view($name)
    {
        $category = Category::where('name', $name)->first();
        $posts = Post::where('category_id', $category->id)->paginate(10);
        $user = Auth::user();

        return view('pages.category', compact('category', 'posts', 'user'));
    }

    // Blokirane kategorije se nece pojavljivati na pocetnoj strani, ali im se moze pristupiti
    public function block($id)
    {
        $user = Auth::user();
        $category = Category::find($id);

        $category->users()->attach($user->id, ['blocked' => true]);

        return redirect('/');        
    }
    // NAPRAVITI TOGGLE UMJESTO ATTACH DETACH
    public function unblock($id)
    {
        $user = Auth::user();
        $category = Category::find($id);

        $category->users()->detach($user->id);

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
