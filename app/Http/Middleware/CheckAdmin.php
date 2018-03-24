<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
    	if(Auth::user()->duty == 'user'){
    		return redirect()->route('logout');
	    }
	    if(Carbon::today()->month!=3){
		    return redirect()->route('logout');
	    }
        return $next($request);
    }
}
