<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyCodeNeeded{

    public function handle($request, Closure $next){
        if(Auth::guard('clients')->user()->phone_verified == 0)
            return redirect()->route('verify');
        return $next($request);
    }
}
