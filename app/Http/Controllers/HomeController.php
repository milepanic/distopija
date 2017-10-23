<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function submit()
    {
        return view('submit');
    }

    public function create()
    {
        return view('create');
    }


    // ADMIN ROUTES

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        
        return view('admin.users', compact('users'));;
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function categories()
    {
        $categories = Category::all();

        return view('admin.categories', compact('categories'));
    }

    public function medals()
    {
        return view('admin.medals');
    }
}
