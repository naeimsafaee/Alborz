<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\ClientComments;
use App\Models\Facility;
use App\Models\HomeSlide;
use App\Models\podcast;
use App\Models\Product;
use App\Models\Service;
use App\Models\video;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function __invoke(Request $request){

        $services = Service::all()->take(6);

        $comments = ClientComments::all()->shuffle()->take(7);

        $slides=HomeSlide::all();

        $facilities = Facility::all();

        $last_products = Product::query()->take(4)->orderByDesc('created_at')->get();

        $last_podcasts = podcast::query()->take(4)->orderByDesc('created_at')->get();
        $last_videos = video::query()->take(4)->orderByDesc('created_at')->get();

        $last_podcasts = $last_podcasts->concat($last_videos)->sortByDesc('created_at')->take(4)->values()->all();

        return view('client.pages.home', compact('services', 'facilities', 'last_products',
            'last_podcasts' , 'comments' , 'slides'));
    }
}
