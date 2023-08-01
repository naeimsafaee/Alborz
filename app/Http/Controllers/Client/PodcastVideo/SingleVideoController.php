<?php

namespace App\Http\Controllers\Client\PodcastVideo;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogToCategory;
use App\Models\Exam;
use App\Models\ExamToServiceCategory;
use App\Models\Product;
use App\Models\VideoComment;
use App\Models\VideoToCategory;
use App\Models\VideoToServiceCategory;
use App\Models\video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SingleVideoController extends Controller{

    public function __invoke($slug){

        $slug = str_replace("_", " ", $slug);
        $video = video::query()->where('title', '=', $slug)->firstOrFail();

        $related = [];

        $categories_id = VideoToCategory::query()->where('video_id', '=', $video->id)->get();

        foreach($categories_id as $category_id){
            $videos = video::query()->whereHas('categories', function (Builder $query) use($category_id) {
                $query->where('category_id', '=', $category_id->category_id);
            })->get();


            foreach($videos as $v){
                if(count($related) >= 3)
                    break;
                if($v->id == $video->id)
                    continue;
                $related[] = $v;
            }
        }
/*
        foreach($categories_id as $category_id){
            if(count($related) > 3)
                break;
            $v = $category_id->video;

            /*if($v->id == $video->id)
                continue;
            $related[] = $v;
        }*/

//        die(json_encode($related));
        $related = array_unique($related);

        $video_path = $video->video_link;

        return view('client.podcast_video.single_video', compact('video' , 'related' , 'video_path'));
    }

    public function set_commet(Request $request){

        $video_comment = VideoComment::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'video_id' => $request->video_id,
            'text' => $request->text
        ]);

        return response()->json(true);
    }

}
