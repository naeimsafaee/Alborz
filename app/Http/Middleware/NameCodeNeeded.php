<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NameCodeNeeded{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::guard('clients')->user()->name)
            return redirect()->route('profile_edit');
        return $next($request);
    }
}
