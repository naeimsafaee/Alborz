<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class podcast extends Model{

    protected $appends = ['slug', 'is_video', 'shamsi_date' , 'is_podcast'];

    public function getIsVideoAttribute(){
        return false;
    }

    public function getIsPodcastAttribute(){
        return true;
    }

    public function getShortDescAttribute(){
        $str = substr(strip_tags($this->description), 0, 300);
        return (substr($str, 0, strrpos($str, " "))) . "....";
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

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }

    public function categories(){
        return $this->hasManyThrough(BlogCategory::class,
            PodcastToCategory::class,
            'podcast_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'category_id' // Local key on the environments table...
        );
    }

    public function service_categories(){
        return $this->hasManyThrough(
            Service_Category::class,
            PodcastToServiceCategory::class,
            'podcast_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'service_category_id' // Local key on the environments table...
        );
    }

    public function comments(){
        return $this->hasMany(PodcastComment::class, 'podcast_id' , 'id')->where('is_active' , '=' , true);
    }

}
