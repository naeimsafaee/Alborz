<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Notification;
use App\Notifications\WinnerNotification;

class NotificationObserver
{
    /**
     * Handle the notification "created" event.
     *
     * @param  \App\Models\Notification $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        return;//todo
        $client = Client::query()->first();
        $client->notify(new WinnerNotification(
            true,
            $notification->title,
            $notification->body,
            $notification->spanned_text,
            $notification->client_id,
            $notification->blog_id
        ));
    }


}
