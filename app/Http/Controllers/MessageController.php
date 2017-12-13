<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function inbox()
    {
    	$user = Auth::user();
    	$messages = $user->messages()
                         ->groupBy('user_id')
                         ->having('reciever_id', $user->id)
                         ->get();

    	return view('pages.inbox.inbox', compact('messages'));
    }

    public function compose($id = null)
    {
    	return view('pages.inbox.compose', compact('id'));
    }

    public function new(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

    	$message = Message::create([
    		'content' => $request->content
    	]);

    	$message->users()->attach(
            Auth::id(), 
            ['reciever_id' => $request->reciever]
        );
        // ako je request is compose-a, redirektuj na inbox, a ako je is message - redirekt back
    	return redirect('inbox');
    }

    public function messages($id)
    {
        $user = Auth::user();
        $messages = $user->messages()
                         ->where([
                             ['reciever_id', $user->id], 
                             ['user_id', $id],
                         ])
                         ->get();

        return view('pages.inbox.view', compact('user', 'messages'));
    }
}
