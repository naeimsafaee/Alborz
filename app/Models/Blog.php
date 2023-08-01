<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model{

    protected $appends = ['short_desc', 'shamsi_date', 'slug'];

    public function getShortDescAttribute(){
        $str = substr(str_replace("&nbsp;", '', strip_tags($this->description)), 0, 300);
        return (substr($str, 0, strrpos($str, " "))) . "....";
    }

    public function getShamsiDateAttribute(){
        if(!$this->created_at)
            return "";
        $date = jdate($this->created_at);
        $date = substr($date , 0 , strpos($date , " "));

        $date = explode("-" , $date);

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

        return implode(" " , $date);
    }

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }

    public function categories()
    {
        return $this->hasManyThrough(
            BlogCategory::class,
            BlogToCategory::class,
            'blog_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'category_id' // Local key on the environments table...
        );
    }

    public function service_categories()
    {
        return $this->belongsToMany(
            Service_Category::class,
            BlogToServiceCategory::class,
            'blog_id',
            'service_category_id'
        );
    }

    public function tags()
    {
        return $this->hasManyThrough(
            Tag::class,
            BlogToTag::class,
            'blog_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'tag_id' // Local key on the environments table...
        );
    }

    public function doctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function comments(){
        return $this->hasMany(BlogComment::class, 'blog_id' , 'id')->where('is_active' , '=' , true);
    }
}
