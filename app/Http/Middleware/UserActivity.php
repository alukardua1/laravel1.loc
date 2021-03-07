<?php

namespace App\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
	    if(Auth::check()) {
		    $expiresAt = Carbon::now()->addMinutes(5);
		    Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
	    }
	    return $next($request);
    }
}
