<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\podcast;
use App\Models\PodcastComment;
use App\Models\PodcastToServiceCategory;
use App\Models\VideoComment;
use App\Models\VideoToServiceCategory;
use App\Models\video;
use Illuminate\Http\Request;

class SinglePodcastController extends Controller{

    public function __invoke($slug){

        $slug = str_replace("_", " ", $slug);
        $podcast = podcast::query()->where('title', '=', $slug)->first();

        $related = [];

        $categories_id = PodcastToServiceCategory::query()->where('podcast_id', '=', $podcast->id)->get();

        foreach($categories_id as $category_id){
            if(count($related) >= 3)
                break;
            $p = podcast::query()->find($category_id->podcast_id);
            if($p->id == $podcast->id)
                continue;
            $related[] = $p;
        }

        $audio_path = $podcast->podcast_link;

        return view('client.podcast_video.single_podcast', compact('podcast' , 'related' , 'audio_path'));
    }

    public function set_commet(Request $request){

        PodcastComment::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'podcast_id' => $request->podcast_id,
            'text' => $request->text
        ]);

        return response()->json(true);
    }

}
