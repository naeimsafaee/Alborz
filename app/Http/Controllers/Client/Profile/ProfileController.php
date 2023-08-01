<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientExam;
use App\Models\CLientSupport;
use App\Models\Exam;
use App\Models\FinishedExam;
use App\Models\Support;
use Illuminate\Http\Request;

class ProfileController extends Controller{

    public function __invoke(Request $request){
        $client_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($client_id);

        $client_exams = ClientExam::query()->where(['client_id' => auth()->guard('clients')->user()->id])->orderByDesc('created_at')->get();

        $exams = [];

        $i = 0;
        foreach($client_exams as $client_exam){
            $exam = Exam::query()->find($client_exam->exam_id);

            $exams[$i] = $exam;
            $exams[$i]["shamsi_date1"] = $client_exam->shamsi_date;

            $i++;
        }

        $support = CLientSupport::query()->where('client_id' , auth()->guard('clients')->user()->id)->orderByDesc('created_at')->get();

        return view('client.profile.profile', compact('client' , 'exams' , 'support'));
    }

    public function edit(Request $request){
        $user_id = auth()->guard('clients')->user()->id;
        $client = Client::query()->find($user_id);
        $client->name = $request->name;
        $client->address = $request->address;
        $client->save();
        return redirect()->route('profile');
    }
}



