<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function banUser($id)
    {
    	$user = Auth::user()->find($id);

    	$user->banned_until = '2016-11-12';
    	$user->ban_message = 'Breaking of rules';

    	$user->save(); 

    	return redirect()->back();
    }

    public function unbanUser($id)
    {
    	$user = Auth::user()->find($id);

    	$user->banned_until = null;
    	$user->ban_message = null;

    	$user->save();

    	return redirect()->back();
    }
}
