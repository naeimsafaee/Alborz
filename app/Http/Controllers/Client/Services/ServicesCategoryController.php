<?php

namespace App\Http\Controllers\Client\Services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Service_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServicesCategoryController extends Controller{

    public function __invoke($slug){
        $flag = Session::get('flag');
        if($flag === 1)
            Session::put('flag', 0);
        else
            Session::remove('flag');

        $service = Service_Category::query()->where('title' , '=' ,
            str_replace("_" , " " , $slug))->firstOrFail();

        $service->doctor;
        $service->blogs;
        $service->podcasts;
        $service->exams;


        return view('client.services.services_category' , compact('service'));
    }
}
