<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Notifications\SendSMS;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class RegisterController extends Controller{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
    }

    protected function validator(array $data){
        if(substr($data["phone"], 0, 1) == 0)
            $data["phone"] = substr($data["phone"], 1);

        return Validator::make($data, [
            'phone' => ['required', 'iran_mobile', 'max:11'],
        ]);
    }

    protected function create(array $data){

        $code = rand(1000, 9999);

        $client = Client::query()->updateOrCreate([
            'phone' => $data['phone'],
        ], [
            'phone' => $data['phone'],
            "verify_code" => $code,
            "phone_verified" => 0,
        ]);

        $client->notify(new SendSMS($client->phone, $code));

        return $client;
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();

        $client = $this->create($request->all());

        $session = new Session();
        $session->set('phone', $client->phone);


        return redirect()->route('verify');
    }

}
