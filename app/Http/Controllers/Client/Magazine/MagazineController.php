<?php

namespace App\Http\Controllers\Client\Magazine;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class MagazineController extends Controller{

    public function __invoke(Request $request){

        $newest_blogs = Blog::query()->orderByDesc('created_at')->paginate(12);
        $most_viewed_blogs = Blog::query()->orderByDesc('view')->take(6)->get();
        $categories = BlogCategory::all()->take(6);


        $tags = Tag::all();


        return view('client.magazine.magazine' , compact('newest_blogs' , 'most_viewed_blogs' , 'tags' , 'categories'));
    }
}
