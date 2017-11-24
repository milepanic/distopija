<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\User;
use Auth;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if(Auth::check()) {
            // Gets all posts which category the user did not block
            // Gets 'id' of where blocked = 1 from pivot table and shows posts which category does not have that 'id'
            $blocked = $user->categories()
                            ->where('blocked', 1)
                            ->get()
                            ->pluck(['id'])
                            ->toArray();

            $posts = Post::whereNotIn('category_id', $blocked)
                            ->with('comments.user', 'user', 'category')
                            ->latest()
                            ->paginate(10);
        } else {
            $posts = Post::with('user', 'category')->latest()->paginate(10);
        }

        return view('pages.welcome', compact('user', 'posts', 'comments.user'));
    }

    public function profile($slug)
    {
        $user = User::where('slug', $slug)->first();
        
        // $posts = $user->posts()->get();
        $posts = $user->favoritePosts()->get();
        // withCount()

        return view('pages.profile', compact('user', 'posts'));
    }

    public function edit($slug)
    {
        if(Auth::user()->slug !== $slug)
            abort(403); // postaviti gate

        $user = Auth::user()->where('slug', $slug)->first();

        return view('pages.editUser', compact('user'));
    }

    public function update($id, Request $request)
    {
        if(!Auth::user()->id === $id)
            abort(403);
            
        $user = Auth::user()->find($id);

        $name = request('name');
        $email = request('email');
        $description = request('description');
        $slug = str_slug($name);

        $user->name = $name;
        $user->email = $email;
        $user->description = $description;
        $user->slug = $slug;

        if($request->file('image') !== null)
        {
            $image = $request->file('image');
            $location = public_path('images/users/' . $user->id);

            Image::make($image)->resize(300, 300)->encode('png')->save($location);           
        }

        $user->save();

        return redirect('profile/' . $user->slug);
    }

    public function cropper(Request $request)
    {
        $image = request('croppedImage');
        $extension = $image->getClientOriginalExtension();
        $user = $request->user();
        $location = public_path('images/users/' . $user->id . '.png');

        Image::make($image)->resize(300, 300)->encode('png')->save($location);

        return response()->json('Operacija uspjesna!');
    }

    public function blocked($slug)
    {
        $user = User::where('slug', $slug)->first();
        $blocked = $user->categories()->where('blocked', 1)->get();

        return view('pages.blocked', compact('blocked'));
    }

    public function submit()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('pages.submit', compact('categories'));
    }

    public function create()
    {
        return view('pages.create');
    }
}
