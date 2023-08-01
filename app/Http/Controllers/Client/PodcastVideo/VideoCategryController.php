<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Service;
use Illuminate\Http\Request;

class VideoCategryController extends Controller
{

    public function __invoke($slug)
    {
        $videos = BlogCategory::query()->where('title' , '=' ,
            str_replace("_" , " " , $slug))->firstOrFail();

        $videos->categories;

        return view('client.podcast_video.all_videos_category',compact('videos'));
    }
}
