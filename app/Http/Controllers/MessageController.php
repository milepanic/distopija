<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function view()
    {
    	$user = Auth::user();
    	$messages = $user->messages()->where('reciever_id', Auth::user()->id)->get();

    	return view('pages.inbox.inbox', compact('messages'));
    }

    public function compose()
    {
    	return view('pages.inbox.compose');
    }

    public function new(Request $request)
    {
    	$user = Auth::user(); 

    	$message = Message::create([
    		'content' => request('content'),
    	]);

    	$message->users()->attach($user, ['reciever_id' => 1]);

    	return redirect('inbox');
    }
}
