<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRegister
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
        if(Auth::check() && !Auth::user()->isAdmin()) {
            return redirect('home')->with('status', 'warning')->with('title', 'Uh Oh!')->with('message', 'You are not allowed to view that resource.');
        }
        
        return $next($request);
    }
}
