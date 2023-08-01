<?php

namespace App\Http\Controllers\Client\Magazine;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class MagazineCategoryController extends Controller
{

    public function __invoke( Request $request , $slug)
    {

        $tags= Tag::all();
        $tag = Tag::query()->where('title' , '=' ,
            str_replace("_" , " " , $slug))->firstOrFail();
        $blogs=$tag->blogs()->paginate(12);
        return view('client.magazine.magazine_category' , compact('blogs' , 'tag' , 'tags'));

    }
}
