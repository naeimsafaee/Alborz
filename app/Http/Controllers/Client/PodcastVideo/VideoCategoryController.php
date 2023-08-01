<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Service;
use Illuminate\Http\Request;

class VideoCategoryController extends Controller
{

    public function __invoke($slug)
    {
        $slug = str_replace("_", " ", $slug);
        $category = BlogCategory::query()->where('title' , '=' , $slug)->firstOrFail();
        $videos = $category->videos()->paginate(12);

        //  die(json_encode($videos));
        return view('client.podcast_video.all_videos_category',compact('videos' , 'slug'));
    }
}
