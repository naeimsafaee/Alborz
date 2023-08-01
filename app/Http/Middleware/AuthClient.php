<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthClient{


    public function handle($request, Closure $next){

        if(!Auth::guard('clients')->check()){
            return redirect()->route('login');
        }

        if(Auth::guard('clients')->user()->phone_verified == 0)
            return redirect()->route('login');

        return $next($request);
    }
}
