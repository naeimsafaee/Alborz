<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CLientSupport;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SupportController extends Controller{

    public function store_admin(Request $request){
        Validator::make($request->all(), [
            'text' => ['required', 'string'],
            'client_id' => ['required', 'exists:clients,id'],
        ])->validate();

        $client_id = $request->client_id;

        $support = CLientSupport::query()->create([
            'client_id' => $client_id,
            'text' => $request->text,
            'is_admin' => true,
        ]);

        return _response("ok");
    }

    public function store(Request $request){
        Validator::make($request->all(), [
            'text' => ['required', 'string'],
            'file' => ['file'],
        ])->validate();

        $client_id = auth()->guard('clients')->user()->id;

        $fileName = "";
        if($request->has('file')){
            $file = $request->file;

            $fileName = 'files/' . time() . '-' . rand() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->put($fileName, file_get_contents($file));
        }

        CLientSupport::query()->create([
            "text" => $request->text,
            "client_id" => $client_id,
            "is_admin" => false,
            "file" => $fileName,
        ]);

        return redirect()->route('profile');
    }

}
