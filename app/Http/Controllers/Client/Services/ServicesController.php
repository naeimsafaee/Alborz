<?php

namespace App\Http\Controllers\Client\Services;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\ClientComments;
use App\Models\Exam;
use App\Models\ExamToServiceCategory;
use App\Models\Service;
use App\Models\service_To_Scategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller{

    public function __invoke($slug){
        $flag = Session::get('flag');
        if($flag === 1)
            Session::put('flag', 0);
        else
            Session::remove('flag');

        $service = Service::query()->where('title', '=', str_replace("_", " ", $slug))->firstOrFail();

        //        $products = $service->with('categories.products')->get()->map(function($products){
        //            return collect($products->categories->toArray())->pluck('products')->collapse()->all();
        //        })->collapse()->unique('id')->values();

        $products = $service->products->take(4);

        $categories = $service->categories;

        $exams = collect();


        foreach($categories as $category){
            $exam_to_service_categoies = ExamToServiceCategory::query()->where('service_category_id', '=', $category->id)->get();

            foreach($exam_to_service_categoies as $exam_to_service_categoy){
                $e = Exam::query()->find($exam_to_service_categoy->exam_id);
                /*if($exams->count() >= 6)
                    break;*/
                $exams->push($e);
            }

        }

        //        die(json_encode($exams));

        $exams = $exams->unique('id')->values();

        /* $exams = $service->with('categories.exams')->get()->map(function($products){
             return collect($products->categories->toArray())->pluck('exams')->collapse()->all();
         })->collapse()->unique('id')->values();*/

        $comments = $service->comments->take(7);

        //        die(json_encode($comments));


        $video_path = $service->video;

        return view('client.services.services', compact('service', 'products', 'exams', 'comments', 'video_path'));
    }

    public function appointment(Request $request){
        $request->validate([
            'doctor_id' => ['required', 'integer'],
            'name' => ['required'],
            'phone' => ['required', 'iran_mobile'],
            'description' => ['required'],
        ], [
            'name.required' => "نام الزامی است.",
            'phone.required' => "شماره همراه الزامی است.",
            'description.required' => "متن پیام الزامی است.",
        ]);

        if(!$request->doctor_id)
            $doctor_id = 0; else
            $doctor_id = $request->doctor_id;

        Appointment::query()->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'description' => $request->description,
            'doctor_id' => $doctor_id,
        ]);
        Session::put('flag', 1);
        return Redirect()->back();
    }

}
