<?php

namespace App\Http\Controllers;

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


    //admin routes
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function posts()
    {
        return view('admin.posts');
    }

    public function categories()
    {
        return view('admin.categories');
    }

    public function medals()
    {
        return view('admin.medals');
    }
}
