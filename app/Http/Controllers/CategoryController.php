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
    	Category::create([
    		'name' => request('name'),
    		'nsfw' => request('nsfw'),
    		'cover_box' => request('cover_box'),
    		'pictures' => request('pictures'),
    		'videos' => request('videos')
    	]);

    	return redirect('create');
    }

    public function view($name)
    {
        $category = Category::where('name', $name)->first();
        $posts = Post::where('category_id', $category->id)->paginate(10);

        return view('pages.category', compact('category', 'posts'));
    }

    // Blokirane kategorije se nece pojavljivati na pocetnoj strani, ali im se moze pristupiti
    public function block($id)
    {
        $user = Auth::user();
        $category = Category::find($id);

        $category->users()->attach($user->id, ['blocked' => 1]);

        return redirect('/');        
    }

    public function approve($id)
    {
        $category = Category::find($id);

        $category->approved = 2;

        $category->save();

        return redirect()->back();
    }

    public function reject($id)
    {
        $category = Category::find($id);

        $category->approved = 1;

        $category->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->back();
    }
}
