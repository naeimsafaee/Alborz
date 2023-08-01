<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthClient{

    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        if(Auth::guard('clients')->check()){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
