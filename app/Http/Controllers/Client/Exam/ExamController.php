<?php

namespace App\Http\Controllers\Client\Exam;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Blog;
use App\Models\ClientExam;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamResultTemp;
use App\Models\ExamToServiceCategory;
use App\Models\Product;
use App\Models\QuestionExam;
use App\Models\RequestResult;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ExamController extends Controller{

    public function __invoke($slug = false){

        $exam = Exam::query()->where('title', '=', str_replace("_", " ", $slug))->firstOrFail();

        $related = [];
        $last_blogs = [];
        $categories_id = ExamToServiceCategory::query()->where('exam_id', '=', $exam->id)->get();

        foreach($categories_id as $category_id){
            $e = Exam::query()->find($category_id->exam_id);
            if($e->id == $exam->id)
                continue;
            $related[] = $e;
        }
        foreach($categories_id as $category_id){
            $products = Product::query()->whereHas('category', function(Builder $query) use ($category_id){
                $query->where('service_category_id', '=', $category_id->service_category_id);
            })->get();
            if(count($last_blogs) >= 3)
                break;

            foreach($products as $product)
                $last_blogs[] = $product;
        }

        //        $last_blogs = Product::query()->take(3)->

        $has_bought = false;

        if(auth()->guard('clients')->check())
            $has_bought = ClientExam::query()->where([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'exam_id' => $exam->id,
                ])->count() > 0;
        if($exam->price == 0){
            $has_bought = true;
        }

        $first_question = QuestionExam::query()->where('exam_id', '=', $exam->id)->firstOrFail();

        $first_question = $first_question->id;

        return view('client.exam.exam', compact('exam', 'related', 'last_blogs', 'has_bought', 'first_question'));
    }

    public function result($exam_id, $code){

        $examResultTemp = ExamResultTemp::query()->where([
            'exam_id' => $exam_id,
            'code' => $code,
        ])->firstOrFail();

        $weight = $examResultTemp->weight;

        RequestResult::query()->create([
            'exam_id' => $exam_id,
            'client_id' => auth()->guard('clients')->user()->id,
            'rate' => $weight,
        ]);

        return view('client.exam.exam_result');
    }

    public function result_admin($exam_id, $code){
        $exam = Exam::query()->findOrFail($exam_id);
        $answer = ExamResult::query()->where('exam_id', '=', $exam->id)->get();

        $examResultTemp = ExamResultTemp::query()->where([
            'exam_id' => $exam->id,
            'code' => $code,
        ])->firstOrFail();

        $weight = $examResultTemp->weight;

        $exam_result = ExamResult::query()->where('exam_id', '=', $exam->id)->where('min', '<=', $weight)->where('max', '>', $weight)->get();

        if($exam_result->count() > 0){
            $answer = $exam_result->first()->text;
        } else
            $answer = $exam->has_answer;

        return view('client.exam.exam_result_admin', compact('answer', 'weight'));
    }

}
