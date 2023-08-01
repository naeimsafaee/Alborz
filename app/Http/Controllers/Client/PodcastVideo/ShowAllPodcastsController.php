<?php

namespace App\Http\Controllers\CLient\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\podcast;
use App\Models\video;
use Illuminate\Http\Request;

class ShowAllPodcastsController extends Controller{

    public function __invoke(Request $request){
        $newest_podcasts = podcast::query()->orderByDesc('created_at')->paginate(12);
        $categories = BlogCategory::all()->take(6);

        return view('client.podcast_video.all_podcasts', compact('newest_podcasts', 'categories'));
    }
}
