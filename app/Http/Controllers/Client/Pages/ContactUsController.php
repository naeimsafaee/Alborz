<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('client.pages.contact_us');

    }


    public function save_form(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'iran_mobile'],
            'description' => ['required'],

        ], [
            'name.required' => "نام الزامی است.",
            'phone.required' => "شماره همراه الزامی است.",
            'description.required' => "متن پیام الزامی است.",

        ]);

        ContactUs::query()->create([
            'name'=>$request->name ,
            'phone'=>$request->phone ,
            'description'=>$request->description]);
        return redirect(route('contact_us'));
    }
}
