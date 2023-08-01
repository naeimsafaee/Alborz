<?php

namespace App\Http\Controllers\Client\Voice;

use App\Http\Controllers\Controller;
use App\Mail\SendVoiceMail;
use App\Models\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Facades\Voyager;

class VoiceController extends Controller{

    public function __invoke(Request $request){
        return View('client.voice.voice');
    }


    public function submit(Request $request) {

        if($request->file('file') && $request->file('file1')){
            $voice = new Voice();
            $voice->client_id = auth()->guard('clients')->user()->id;
            $voice->file = Storage::disk('public')->put('voices', $request->file('file'));
            $voice->response = '';
            $voice->save();


            $voice1 = new Voice();
            $voice1->client_id = auth()->guard('clients')->user()->id;
            $voice1->file = Storage::disk('public')->put('voices', $request->file('file1'));
            $voice1->response = '';
            $voice1->save();

            $client = auth()->guard('clients')->user();

            Mail::to($client->email)->send(new SendVoiceMail(
                Voyager::image($voice->file) , Voyager::image($voice1->file) , $request->number_1 , $request->number_2));


            return _response($request->file('file'), 'got the file');
        }

        return _response(null, 'error', false);
    }

    public function result(Request $request, $voice_id) {
        $voice = Voice::query()->where('id', $voice_id)->where('client_id', auth()->guard('clients')->user()->id)->firstOrFail();
        return view('client.voice.result', compact('voice'));
    }
}
