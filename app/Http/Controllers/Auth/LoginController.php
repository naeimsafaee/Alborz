<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
//        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){

        session(['url.intended' => url()->previous()]);

        return view('auth.login');
    }

    public function logout(){
        auth()->guard('clients')->logout();
        return redirect()->route('home');
    }
}
