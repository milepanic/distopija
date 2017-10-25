<?php

namespace App\Http\Middleware;

use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Session;

class IsBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->isBanned())
        {
            Session::flush();
            return redirect('login')->withInput()->withErrors([
                'email' => 'The account ' . Auth::user()->name . ' has been banned until ' 
                . Carbon::parse(Auth::user()->banned_until)->toFormattedDateString() 
                . " - Reason : " . Auth::user()->ban_message,
            ]);
        }

        return $next($request);
    }
}
