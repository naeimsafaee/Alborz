<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PodcastComment extends Model{

    protected $appends = [
        'reply_to_comment',
        'shamsi_date',
    ];

    protected $fillable = ['client_id', 'podcast_id', 'text'];

    public function getReplyToCommentAttribute(){
        $reply_to = PodcastComment::query()->where('reply_to', '=', $this->id)->first();
        if($reply_to)
            return $reply_to;
        return false;
    }

    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date, 0, strpos($date, " "));

        $date = explode("-", $date);

        switch($date[1]){
            case 1:
                $date[1] = "فروردین";
                break;
            case 2:
                $date[1] = "اردیبهشت";
                break;
            case 3:
                $date[1] = "خرداد";
                break;
            case 4:
                $date[1] = "تیر";
                break;
            case 5:
                $date[1] = "مرداد";
                break;
            case 6:
                $date[1] = "شهریور";
                break;
            case 7:
                $date[1] = "مهر";
                break;
            case 8:
                $date[1] = "آبان";
                break;
            case 9:
                $date[1] = "آذر";
                break;
            case 10:
                $date[1] = "دی";
                break;
            case 11:
                $date[1] = "بهمن";
                break;
            case 12:
                $date[1] = "اسفند";
                break;
        }

        return implode(" ", $date);
    }
}
