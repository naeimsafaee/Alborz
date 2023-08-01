<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supportmessage;
use Illuminate\Http\Request;

class BanneduserController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {
        if ($request->supportmessage_id) {
            $support = Supportmessage::find($request->supportmessage_id);
            if (!$support || $support->user_id != $request->user_id) {
                return redirect()->back()->withErrors(['پیام انتخاب شده معتبر نیست']);
            }

        }
        return parent::store($request);
    }

    public function update(Request $request, $id)
    {
        if ($request->supportmessage_id) {
            $support = Supportmessage::find($request->supportmessage_id);
            if (!$support || $support->user_id != $request->user_id) {
                return redirect()->back()->withErrors(['پیام انتخاب شده معتبر نیست']);
            }

        }
        return parent::update($request, $id);
    }
}
