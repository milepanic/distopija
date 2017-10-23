<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

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
}
