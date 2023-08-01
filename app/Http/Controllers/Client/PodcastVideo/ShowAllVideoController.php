<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Service;
use App\Models\video;
use Illuminate\Http\Request;

class ShowAllVideoController extends Controller
{

    public function __invoke(Request $request)
    {
        $newest_videos = video::query()->orderByDesc('created_at')->paginate(12);
        $categories = BlogCategory::all()->take(6);
        //die(json_encode($categories));

        return view('client.podcast_video.all_videos',compact('newest_videos' , 'categories'));
    }
}
