<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVoiceMail extends Mailable {
    use Queueable, SerializesModels;

    private $link;
    private $link1;
    private $number_1;
    private $number_2;

    public function __construct($link, $link1, $number_1, $number_2) {
        $this->link = $link;
        $this->link1 = $link1;
        $this->number_1 = $number_1;
        $this->number_2 = $number_2;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        $link = $this->link;
        $link1 = $this->link1;
        $number_1 = $this->number_1;
        $number_2 = $this->number_2;

        return $this->view('mail.voice', compact('link1', 'link', 'number_2', 'number_1'));
    }
}
