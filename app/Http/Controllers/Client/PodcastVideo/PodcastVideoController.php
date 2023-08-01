<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\podcast;
use App\Models\video;
use Illuminate\Http\Request;

class PodcastVideoController extends Controller
{
    public function __invoke(Request $request){
        $videos = video::query()->take(4)->get();
        $podcasts = podcast::query()->take(4)->get();
        return view('client.podcast_video.podcast_video' , compact('videos' , 'podcasts'));
    }
}
