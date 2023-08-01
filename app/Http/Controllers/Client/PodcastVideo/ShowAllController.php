<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowAllController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('client.podcast_video.all_videos');
    }
}
