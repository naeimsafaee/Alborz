<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetNameController extends Controller{

    public function __construct(){

    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
        ]);
    }

    protected function edit(array $data){

        $client = Client::query()->find(auth()->guard('clients')->user()->id);
        $client->name = $data["name"];
        $client->save();

        return $client;
    }

    public function show(){
        if(auth()->guard('clients')->user()->name)
            return redirect()->route('profile');
        return view('auth.set_name');
    }

    public function register(Request $request){

        $this->validator($request->all())->validate();

        $this->edit($request->all());

        return redirect()->route('profile');
    }

}
