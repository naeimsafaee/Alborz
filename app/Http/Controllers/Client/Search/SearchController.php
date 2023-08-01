<?php

namespace App\Http\Controllers\Client\Search;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\podcast;
use App\Models\Product;
use App\Models\video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller{

    public function __invoke(Request $request){


        if($request->has('search')) {
            $search = $request->search;

            $podcast = podcast::query()->where('title' , 'LIKE' , "%$search%")->get();
            $video = video::query()->where('title' , 'LIKE' , "%$search%")->get();
            $product = Product::query()->where('name' , 'LIKE' , "%$search%")->get();
            $blog = Blog::query()->where('title' , 'LIKE' , "%$search%")->get();


            $result = $blog->concat($podcast)->concat($product)->concat($video);

            $search = $result->sortByDesc('created_at');

            $count = $blog->count() + $podcast->count() + $product->count() + $video->count();
            $page = $request['page'];
            $perPage = 10;

            $search = new LengthAwarePaginator(
                $search->forPage($page, $perPage), $count, $perPage, $page
            );

//            die(json_encode($search));

        } else
            $search = false;


        return view('client.search.search' , compact('search'));
    }
}
