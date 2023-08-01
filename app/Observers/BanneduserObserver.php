<?php

namespace App\Observers;

use App\Models\Banneduser;

class BanneduserObserver
{
    /**
     * Handle the banneduser "created" event.
     *
     * @param  \App\Banneduser  $banneduser
     * @return void
     */
    public function creating(Banneduser $banneduser)
    {
        $banneduser->byuser_id = auth()->user()->id;
    }

    /**
     * Handle the banneduser "updated" event.
     *
     * @param  \App\Banneduser  $banneduser
     * @return void
     */
    public function updated(Banneduser $banneduser)
    {
        //
    }

    /**
     * Handle the banneduser "deleted" event.
     *
     * @param  \App\Banneduser  $banneduser
     * @return void
     */
    public function deleted(Banneduser $banneduser)
    {
        //
    }

    /**
     * Handle the banneduser "restored" event.
     *
     * @param  \App\Banneduser  $banneduser
     * @return void
     */
    public function restored(Banneduser $banneduser)
    {
        //
    }

    /**
     * Handle the banneduser "force deleted" event.
     *
     * @param  \App\Banneduser  $banneduser
     * @return void
     */
    public function forceDeleted(Banneduser $banneduser)
    {
        //
    }
}
