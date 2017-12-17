<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Category;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index($filter = null)
    {
        $user = Auth::user();

        if($user)
            $posts = Post::notBlocked()
                    ->eagerLoad()
                    ->filter($filter, $user)
                    ->paginate(10);
        else
            $posts = Post::with('user', 'category')
                    ->eagerLoad()
                    ->filter($filter, null)
                    ->paginate(10);

        return request()->ajax() ? 
            view('includes.jokes', compact('user', 'posts'))
            : 
            view('pages.welcome', compact('user', 'posts'));
    }

    public function profile($slug, $filter = null)
    {
        $user = User::where('slug', $slug)
                ->withCount([
                    'posts',
                    'subscription',
                    'subscription as subscribers_count' => function ($query) {
                        $query->whereRaw('subscription.user_id = users.id');
                    },
                    'posts as original_count' => function ($query) {
                        $query->where('original', true);
                    },
                    'favoritePosts as favorite_count' => function ($query) {
                        $query->whereRaw('favorites.user_id = users.id');
                    }
                ])
                ->first();

        $posts = Post::where('user_id', $user->id)
                ->eagerLoad()
                ->profileFilter($filter, $user)
                ->latest()
                ->paginate(10);

        return request()->ajax() ?
            view('includes.jokes', compact('user', 'posts'))
            :
            view('pages.profile', compact('user', 'posts'));
    }

    public function subscribed($slug)
    {
        $user       = User::where('slug', $slug)->withCount('subscription')->first();
        $subscribed = $user->subscription()->paginate(10);

        return view('includes.subscribers', compact('user', 'subscribed'));
    }

    public function subscribers($slug)
    {
        $user       = User::where('slug', $slug)->withCount('subscription')->first();
        $query      = DB::table('subscription')->where('user_id', 1)->pluck('subscriber_id')->toArray();
        $subscribed = User::whereIn('id', $query)->paginate(10);

        return view('includes.subscribers', compact('user', 'subscribed'));
    }

    public function edit($slug)
    {
        if(Auth::user()->slug !== $slug)
            abort(403); // TODO: postaviti gate

        $user = Auth::user()->where('slug', $slug)->first();

        return view('pages.editUser', compact('user'));
    }

    public function update($id, Request $request)
    {
        if(!Auth::user()->id === $id)
            abort(403);

        $request->validate([
            'name'          => 'required|min:3|alpha_num|max:255|unique:users,name,' . Auth::id(),
            'email'         => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'description'   => 'nullable|string|max:1000',
        ]);

        $user = Auth::user()->find($id);

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->description  = $request->description;
        $user->slug         = str_slug($request->name);

        $user->save();

        return redirect('profile/' . $user->slug);
    }

    public function cropper(Request $request)
    {
        $request->validate([
            'croppedImage' => 'required|image',
        ]);

        Image::make($request->croppedImage)
            ->resize(300, 300)
            ->encode('png')
            ->save(public_path('images/users/' . Auth::id() . '.png'));

        return response()->json('Operacija uspjesna!');
    }

    public function blocked($slug)
    {
        $user       = User::where('slug', $slug)->first();
        $blocked    = $user->categories()->where('blocked', true)->get();

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
