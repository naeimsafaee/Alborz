<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupportmessagesResource;
use App\Http\Response;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use TCG\Voyager\Models\Permission;
use \Morilog\Jalali\Jalalian;

class UserApiController extends Controller
{

    public function getusersupports(Request $request)
    {
        $request->validate([
            'limit' => 'integer|max:50',
            'order' => 'in:desc,asc',
        ]);
        $supports = $request->user()->support();
        if ($supports->exists()) {
            $support = $supports->first();
            if ($support->new) {
                $support->new = 0;
                $support->save();
            }
            $banneddata = false;
            if ($request->user()->is_banned) {
                $banned = $request->user()->banned()->first();
                $banneddata = ['reason' => $banned->reason ? $banned->reason : false, 'relatedmessage' => $banned->message()->exists() ? Crypt::decryptString($banned->message()->first()->message) : false, 'banneddate' => Jalalian::fromDateTime($banned->created_at)->format('Y/m/d H:i'), 'banneddate_ago' => Jalalian::fromDateTime($banned->created_at)->ago()];
            }
            $support = SupportmessagesResource::collection($support->messages()->orderby('created_at', $request->order ? $request->order : 'asc')->paginate($request->limit));
            return [
                'data' => $support,
                'banneddata' => $banneddata,
                'meta' => [
                    'current_page' => $support->currentPage(),
                    'last_page' => $support->lastPage(),
                ],
            ];
        } else {
            return Response::create(false, "support message not found");
        }
    }

    public function sendusersupport(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'title' => 'string',
        ]);
        if ($request->user()->is_banned) {
            $banned = $request->user()->banned()->first();
            return Response::create(false, "شما اجازه ارسال پیام جدید را ندارید", ['reason' => $banned->reason ? $banned->reason : false, 'relatedmessage' => $banned->message()->exists() ? Crypt::decryptString($banned->message()->first()->message) : false, 'banneddate' => Jalalian::fromDateTime($banned->created_at)->format('Y/m/d H:i'), 'banneddate_ago' => Jalalian::fromDateTime($banned->created_at)->ago()]);
        }
        $supports = $request->user()->support();
        if ($supports->exists()) {
            $supports = $supports->first();
            $lastmessage = $supports->messages()->where('user_id', $request->user()->id)->orderby('created_at', 'desc')->first();
            //delete 6 month past messages
            $supports->messages()->where('created_at', '<=', now()->subMonths(6))->delete();
            if ($lastmessage->created_at->addSeconds(30)->timestamp > now()->timestamp) {
                return Response::create(false, "باید بین ارسال هر پیام 30 ثانیه صبر کنید");
            }
            $this->addtosupportunread($supports);
            $supports->message_count += 1;
            $supports->save();
            $message = $supports->messages()->create([
                'user_id' => $request->user()->id,
                'message' => Crypt::encryptString($request->message),
            ]);
            return Response::create(true, "پیام با موفقیت ارسال شد", ['id' => $message->id]);
        } else {
            if ($request->title) {
                $support = $supports->create([
                    'title' => $request->title,
                    'message_count' => 1,
                    'status' => 'new',
                    'new' => 0,
                ]);
                $this->addtosupportunread($support);
                $support->messages()->create([
                    'user_id' => $request->user()->id,
                    'message' => Crypt::encryptString($request->message),
                ]);
                return Response::create(true, "پیام با موفقیت ارسال شد");
            } else {
                return Response::create(false, "عنوان برای اولین پیام الزامی است");
            }
        }
    }

    private function addtosupportunread(Support $support)
    {
        $roles = Permission::where('key', 'read_supports')->first()->roles()->first();
        if ($roles) {
            foreach ($roles->users()->get() as $user) {
                $support->unread()->syncWithoutDetaching($user->id);
            }
        }
    }
}
