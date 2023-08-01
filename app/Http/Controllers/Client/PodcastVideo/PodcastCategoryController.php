<?php

namespace App\Http\Controllers\CLient\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class PodcastCategoryController extends Controller{

    public function __invoke($slug){
        $slug = str_replace("_", " ", $slug);
        $category = BlogCategory::query()->where('title', '=', $slug)->firstOrFail();
        $podcasts = $category->podcasts()->paginate(12);
        //  die(json_encode($videos));
        return view('client.podcast_video.all_podcasts_category', compact('podcasts', 'slug'));
    }

    public function category($slug){
        $slug = str_replace("_", " ", $slug);

        $category = BlogCategory::query()->where('title', '=', $slug)->firstOrFail();

        $podcasts = $category->podcasts()->paginate(12);
        //  die(json_encode($videos));
        return view('client.podcast_video.all_podcasts_category', compact('podcasts', 'slug'));
    }
}
