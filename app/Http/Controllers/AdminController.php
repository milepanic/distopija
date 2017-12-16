<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount      = User::count();
        $postCount      = Post::count();
        $originalCount  = Post::where('original', '=', '1')->count();

        return view('admin.dashboard', compact('userCount', 'postCount', 'originalCount'));
    }

    public function users()
    {
        return view('admin.users')->withUsers(User::all());
    }

    public function posts()
    {
        return view('admin.posts')->withPosts(Post::all());
    }

    public function categories()
    {
        return view('admin.categories')->withCategories(Category::all());
    }

    public function medals()
    {
        return view('admin.medals');
    }

    public function reports()
    {
        return view('admin.reports');
    }
}
