<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMS extends Notification implements ShouldQueue
{
    use Queueable;

    public $phone;
    public $message;
    public $template;

    public function __construct($phone, $message , $template = "alborzatra")
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->template = $template;
    }


    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSMS($notifiable)
    {
        return [
            'phone' => $this->phone,
            'message' => $this->message
        ];
    }
}
