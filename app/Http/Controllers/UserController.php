<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function subscribe($id)
    {
        Auth::user()->subscription()->toggle($id);
        // TODO: SESSION FLASH
        return redirect()->back();
    }

    public function banUser(Request $request, $id)
    {
    	$user = User::find($id);

    	$user->banned_until    = $request->date;
    	$user->ban_message     = $request->reason;

    	$user->save();

    	return redirect()->back();
    }

    public function unbanUser($id)
    {
    	$user = User::find($id);

    	$user->banned_until    = null;
    	$user->ban_message     = null;

    	$user->save();

    	return redirect()->back();
    }
}
