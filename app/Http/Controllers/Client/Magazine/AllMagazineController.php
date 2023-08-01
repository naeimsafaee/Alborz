<?php

namespace App\Http\Controllers\Client\Magazine;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\podcast;
use App\Models\Service_Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AllMagazineController extends Controller{

    public function __invoke($slug){

        $slug = str_replace("_", " ", $slug);
        $category = BlogCategory::query()->where('title' , '=' , $slug)->first();

        if($category){
            $blogs = $category->blogs()->paginate(12);
        } else {
            $service_category = Service_Category::query()->where('title' , $slug)->firstOrFail();
            $blogs = Blog::query()->whereHas('service_categories' , function (Builder $query) use($service_category) {
                $query->where('service_category_id', '=', $service_category->id);
            })->paginate(12);
        }


        return view('client.magazine.all_magazine',compact('blogs' , 'slug'));
    }

}
