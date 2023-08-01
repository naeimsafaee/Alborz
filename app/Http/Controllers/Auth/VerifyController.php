<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class VerifyController extends Controller{

    protected $redirectTo = RouteServiceProvider::HOME;
    use RegistersUsers;


    public function __construct(){

    }

    protected function validator(array $data){
        return Validator::make($data, [
            'code' => [
                'required',
                'size:4',
                'exists:clients,verify_code',
                function($attribute, $value, $fail){
                    $session = new Session();
                    $phone = $session->get('phone');

                    $client = Client::query()->where('phone', '=', $phone)->get();
                    if($client->count() > 0 && $client->first()->verify_code == $value){
                        $client = $client->first();
                        $client->phone_verified = 1;
                        $client->save();
                    } else {
                        $fail('کد معتبر نیست!');
                    }
                },
            ],
        ]);
    }


    protected function create(array $data){

        $session = new Session();
        $phone = $session->get('phone');

        $client = Client::query()->where('phone', '=', $phone)->get();
        $client = $client->first();
        $client->phone_verified = 1;
        $client->save();

        return $client;
    }

    public function show(){

        $session = new Session();
        $phone = $session->get('phone');

        if(!$phone)
            return redirect()->route('login');

        return view('auth.verify');
    }

    public function register(Request $request){

        $this->validator($request->all())->validate();

        $client = $this->create($request->all());


        auth()->guard('clients')->login($client , true);
        $this->registered($request, $client);

/*
        if(!$client->name)
            return redirect()->route('editProfile');*/

        return redirect()->intended();
//        return redirect()->route('profile');
    }

}
