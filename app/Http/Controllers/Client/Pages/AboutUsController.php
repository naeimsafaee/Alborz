<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Gallery1;
use App\Models\Gallery2;
use Illuminate\Http\Request;
use function React\Promise\all;

class AboutUsController extends Controller
{

    public function __invoke(Request $request)
    {
        $images = Gallery1::all();
        $galleries = Gallery2::all();
        return view('client.pages.about_us' , compact('images' , 'galleries'));
    }
}
