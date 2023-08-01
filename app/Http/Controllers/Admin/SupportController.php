<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\SuppormessageselectboxResource;
use App\Http\Resources\SupportmessagesResource;
use App\Models\Banneduser;
use App\Models\Support;
use App\Models\Supportmessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SupportController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function create(Request $request)
    {
        return redirect()->back();
    }

    public function store(Request $request)
    {
        return redirect()->back();
    }

    public function sendmessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'id' => 'exists:supports',
        ]);
        $support = Support::find($request->id);
        if ($support->status != 'closed') {
            $data = $support->messages()->create([
                'user_id' => auth()->user()->id,
                'client_id' => $support->messages()->first()->client_id,
                'message' => Crypt::encryptString($request->get('content')),
            ]);
            $support->message_count += 1;
            $support->new = 1;
            $support->status = 'replied';
            $support->save();
            return ['success' => true, 'date_fa' => \Morilog\Jalali\Jalalian::now()->format('j F y H:i'), 'date_en' => \Carbon\Carbon::now()->format('j F y H:i')];
        } else {
            return ['success' => false];
        }
    }

    public function readmessage(Request $request)
    {
        $request->validate([
            'id' => 'exists:supports',
        ]);
        if (Supportmessage::where('support_id', $request->id)->where('user_id', auth()->user()->id)) {
            auth()->user()->unreadsupport()->detach($request->id);
        }
        return ['success' => true];
    }

    public function getmessages(Request $request)
    {
        $request->validate([
            'id' => 'exists:supports',
        ]);
        $support = Support::find($request->id);
        return SupportmessagesResource::collection($support->messages()->orderby('created_at', 'desc')->paginate(10));
    }

    public function lockmessage(Request $request)
    {
        $request->validate([
            'id' => 'exists:supports',
        ]);
        $support = Support::find($request->id);
        if ($support->status == 'closed') {
            $support->status = 'waiting';
        }

        $support->save();
        return ['success' => true, 'status' => $support->status];
    }

    /*public function createmessage(Request $request){
    $request->validate([
    'content' => 'required|string',
    'user_id' => 'exists:users,id',
    ]);
    $User = User::find($request->user_id);
    $support = $User->support()->create([
    'title' => $request->content,
    'status' => 'new',
    'messages' => ['data' => [
    ['id'=>1,'user_id'=>$request->user_id,'username'=>$User->name,"is_admin"=>true,'message'=>$request->content,'date'=>now(),'date_fa'=>\Morilog\Jalali\Jalalian::now()->format('j F y H:i'),'date_en' => \Carbon\Carbon::now()->format('j F y H:i')]
    ]]
    ]);
    return ['success' => true,'data'=>$support,'date_fa'=>\Morilog\Jalali\Jalalian::now()->format('j F y H:i'),'date_en'=>\Carbon\Carbon::now()->format('j F y H:i')];
    }*/
    public function banuser(Request $request)
    {
        $request->validate([
            'id' => 'exists:supports',
        ]);
        $support = Support::find($request->id);
        $banneduser = Banneduser::where('user_id', $support->user_id);
        if ($banneduser->exists()) {
            if ($banneduser->first()->byuser_id == auth()->user()->id) {
                $banneduser->delete();
                return ['success' => true, 'banned' => true];
            }
            return ['success' => true, 'banned' => false];
        } else {
            auth()->user()->bannedby()->create([
                'user_id' => $support->user_id,
                'messages_id' => 0,
            ]);
            return ['success' => true, 'banned' => true];
        }
    }

    public function messagesearch(Request $request)
    {
        $request->validate([
            'userid' => 'required|exists:users,id',
            'search' => 'string',
        ]);
        $supportmessage = new Supportmessage;
        if ($request->search) {
            //$supportmessage = $supportmessage->where('message', 'like', "%".$request->search."%");
        }
        if ($request->userid) {
            $supportmessage = $supportmessage->where('user_id', $request->userid);
        }
        return SuppormessageselectboxResource::collection($supportmessage->select('id', 'message as text')->orderby('created_at', 'desc')->paginate(10));
    }
}
