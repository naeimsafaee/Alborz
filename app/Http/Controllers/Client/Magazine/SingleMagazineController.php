<?php

namespace App\Http\Controllers\Client\Magazine;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class SingleMagazineController extends Controller{

    public function __invoke($slug){
        $slug = str_replace("_", " ", $slug);
        $blog = Blog::query()->where('title', '=', $slug)->firstOrFail();
//        die(json_encode($blog));
        return view('client.magazine.single_magazine', compact('blog'));
    }

    public function set_commet(Request $request){

        $blog_comment = BlogComment::query()->create([
            'client_id' => auth()->guard('clients')->user()->id,
            'blog_id' => $request->blog_id,
            'text' => $request->text
        ]);

        return response()->json(true);
    }

}
