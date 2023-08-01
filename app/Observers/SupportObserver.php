<?php

namespace App\Observers;

use App\Models\Support;

class SupportObserver
{
    /**
     * Handle the support "created" event.
     *
     * @param  \App\Support  $support
     * @return void
     */
    public function created(Support $support)
    {
        /*if(isset($support->messages['data']) && !is_null($support->messages['data'])){
    $support->message_count = count($support->messages['data']);
    $support->new = true;
    $support->save();
    $user = User::find($support->messages['data'][0]['user_id']);
    if($user){
    $user->supportmessage()->syncWithoutDetaching($support->id);
    }
    }

    $roles = Permission::where('key','read_supports')->first()->roles()->first();
    if($roles){
    $data = $support->messages['data'];
    if(!is_null($data)){
    $lastentry = end($data);
    foreach($roles->users()->get() as $user){
    if($user->id != $lastentry['user_id']){
    $support->unread()->syncWithoutDetaching($user->id);
    }
    }
    }
    }*/
    }

    /**
     * Handle the support "updated" event.
     *
     * @param  \App\Support  $support
     * @return void
     */
    public function updating(Support $support)
    {
        /*if($support->isDirty('messages')){
    $support->message_count = count($support->messages['data']);
    $support->new = true;
    $roles = Permission::where('key','read_supports')->first()->roles()->first();
    if($roles){
    $data = $support->messages['data'];
    if(!is_null($data)){
    $lastentry = end($data);
    foreach($roles->users()->get() as $user){
    if($user->id != $lastentry['user_id']){
    $support->unread()->syncWithoutDetaching($user->id);
    }
    }
    $userow = User::find($lastentry['user_id']);
    if($userow){
    $userow->supportmessage()->syncWithoutDetaching($support->id);
    }
    }
    }
    }*/
    }

    /**
     * Handle the support "deleted" event.
     *
     * @param  \App\Support  $support
     * @return void
     */
    public function deleted(Support $support)
    {
        $support->unread()->detach();
        $support->messages()->delete();
    }

    /**
     * Handle the support "restored" event.
     *
     * @param  \App\Support  $support
     * @return void
     */
    public function restored(Support $support)
    {
        //
    }

    /**
     * Handle the support "force deleted" event.
     *
     * @param  \App\Support  $support
     * @return void
     */
    public function forceDeleted(Support $support)
    {
        //
    }
}
