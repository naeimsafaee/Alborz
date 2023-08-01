<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AboutDrController extends Controller
{

    public function __invoke($slug)
    {
        $slug=str_replace("_", " ", $slug);

        $doctor = Doctor::query()->where('full_name' , '=' , $slug)->first();

//        die(json_encode($doctor));
        return view('client.pages.about_dr' , compact('doctor'));
    }
}
