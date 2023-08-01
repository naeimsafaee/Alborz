<?php

namespace App\Http\Controllers\Client\Exam;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Client;
use App\Models\ClientExam;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamResultTemp;
use App\Models\FinishedExam;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionExam;
use App\Models\RequestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class QuestionsController extends Controller {

    public function __invoke($exam_id, $code, $step = 0) {

        $exam = Exam::query()->find($exam_id);

        $question_exam = QuestionExam::query()->where('exam_id', '=', $exam_id)->get();

        $total = $question_exam->count();

        $examResultTemp = ExamResultTemp::query()->where([
            'exam_id' => $exam->id,
            'code' => $code,
        ])->get();

        if ($code == 0 && $exam->price == 0)
            ClientExam::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'exam_id' => $exam->id,
            ]);

        if ($examResultTemp && $examResultTemp->count() > 0) {

            $code = $examResultTemp->first();
            if ($code)
                $code = $code->code;

        } else {
            $code = rand(1000, 999999);

            ExamResultTemp::query()->create([
                'exam_id' => $exam->id,
                'code' => $code,
                'weight' => 0,
            ]);
        }

        if ($step >= $total) {

            $examResultTemp = ExamResultTemp::query()->where([
                'exam_id' => $exam->id,
                'code' => $code,
            ])->firstOrFail();

            $weight = $examResultTemp->weight;

            $exam_result = ExamResult::query()->where(['exam_id' => $exam->id])->where('min', '<=', $weight)->where('max', '>', $weight)->get();

            $finish = FinishedExam::query()->create([
                'exam_id' => $exam_id,
                'client_id' => auth()->guard('clients')->user()->id,
                'code' => $code,
                'weight' => $weight,
            ]);

            if ($exam->has_answer || $exam_result->count() > 0) {
                if ($exam_result->count() > 0) {

                    $finish->answer = $exam_result->first()->text;
                } else {
                    $finish->answer = $exam->has_answer;
                }
                $finish->save();
                return redirect()->route('exam_result_admin', [$exam->id, $code]);
            } else {
                return redirect()->route('exam_result', [$exam->id, $code]);
            }
        }

        $question = Question::query()->findOrFail($question_exam->skip($step)->first()->question_id);

        if ($question->type == 0) {
            return view('client.exam.question_upload_file', compact('question', 'total', 'step', 'exam', 'code'));
        } elseif ($question->type == 1) {
            return view('client.exam.question_yes_or_no', compact('question', 'total', 'step', 'exam', 'code'));
        } else {
            return view('client.exam.question_multiple_select', compact('question', 'total', 'step', 'exam', 'code'));
        }
    }

    public function show_answer($exam_id) {

        $finish = FinishedExam::query()->where([
            "exam_id" => $exam_id,
            'client_id' => auth()->guard('clients')->user()->id,
        ])->get();

        $request = RequestResult::query()->where([
            "exam_id" => $exam_id,
            'client_id' => auth()->guard('clients')->user()->id,
        ])->get();

        if ($finish && $finish->count() > 0 && $finish->first()->answer) {
            $finish = $finish->first();
            $answer = $finish->answer;
            $weight = $finish->weight;
        } elseif ($request && $request->count() > 0) {
            $request = $request->first();
            if ($request->answer) {
                $answer = $request->answer;
                $weight = $request->rate;
            } else {
                $answer = 'در انتظار پاسخ';
                $weight = $request->rate;
            }

        } else {
            $answer = 'در انتظار پاسخ';
            $weight = 'نامعلوم';
        }

        return view('client.exam.exam_result_admin', compact('answer', 'weight'));
    }

    public function answer(Request $request) {
        Validator::make($request->all(), [
            'file' => [
                'file',
                'required',
            ],
        ], ["file.required" => "فایل اپلودی الزامی است."])->validate();

        $file = $request->file('file');

        $fileName = time() . '-' . rand() . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->put('files/' . $fileName, file_get_contents($file));

        $client_id = auth()->guard('clients')->user()->id;

        Answer::query()->create([
            'question_id' => $request->question_id,
            'exam_id' => $request->exam_id,
            'client_id' => $client_id,
            'file' => get_image('files/' . $fileName),
            'answer' => "file",
        ]);
        return redirect()->route('questions', [$request->exam_id, $request->code, $request->step]);
    }

    public function answer_1(Request $request) {

        if (auth()->guard('clients')->check())
            $client_id = auth()->guard('clients')->user()->id;
        else
            $client_id = 1;

        $examResultTemp = ExamResultTemp::query()->where([
            'exam_id' => $request->exam_id,
            'code' => $request->code,
        ])->firstOrFail();

        if ($request->option_id) {
            $option = Option::query()->findOrFail($request->option_id);

            Answer::query()->create([
                'question_id' => $request->question_id,
                'exam_id' => $request->exam_id,
                'client_id' => $client_id,
                'file' => null,
                'answer' => $option->text . " - " . $request->description,
                'weight' => $option->weight,
            ]);

            $examResultTemp->weight += $option->weight;
        } else {
            Answer::query()->create([
                'question_id' => $request->question_id,
                'exam_id' => $request->exam_id,
                'client_id' => $client_id,
                'file' => null,
                'answer' => "بدون انتخاب",
                'weight' => 0,
            ]);

            $examResultTemp->weight += 0;
        }

        $examResultTemp->save();

        return redirect()->route('questions', [$request->exam_id, $request->code, $request->step]);
    }

    public function answer_2(Request $request) {

        if (auth()->guard('clients')->check())
            $client_id = auth()->guard('clients')->user()->id;
        else
            $client_id = 1;

        $examResultTemp = ExamResultTemp::query()->where([
            'exam_id' => $request->exam_id,
            'code' => $request->code,
        ])->firstOrFail();

        if ($request->answers === null) {
            $examResultTemp->weight += 0;

            Answer::query()->create([
                'question_id' => $request->question_id,
                'exam_id' => $request->exam_id,
                'client_id' => $client_id,
                'file' => null,
                'answer' => "بدون انتخاب",
                'weight' => 0,
            ]);
        } else {

            $answers = explode("-", $request->answers);
            foreach(array_filter($answers) as $answer) {

                $option = Option::query()->find($answer);

                if ($option) {
                    $examResultTemp->weight += $option->weight;

                    Answer::query()->create([
                        'question_id' => $request->question_id,
                        'exam_id' => $request->exam_id,
                        'client_id' => $client_id,
                        'file' => null,
                        'answer' => $option->text,
                        'weight' => $option->weight,
                    ]);
                }

            }

        }
        $examResultTemp->save();

        return redirect()->route('questions', [$request->exam_id, $request->code, $request->step]);
    }

}
