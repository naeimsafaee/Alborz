<?php

namespace App\Models;

use App\Models\video;
use Illuminate\Database\Eloquent\Model;

class Service_Category extends Model{
    protected $table = "service_categories";

    protected $appends = [
        'slug', 'podcasts_and_videos' ,
    ];

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }

    public function doctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function blogs(){
        return $this->hasManyThrough(
            Blog::class,
            BlogToServiceCategory::class,
            'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'blog_id' // Local key on the environments table...
        )->orderByDesc('created_at')->take(3);
    }

    public function podcasts(){
        return $this->hasManyThrough(
            podcast::class,
            PodcastToServiceCategory::class,
            'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'podcast_id' // Local key on the environments table...
        )->orderByDesc('created_at')->take(4);
    }

    public function videos(){
        return $this->hasManyThrough(
            video::class,
            VideoToServiceCategory::class,
            'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'video_id' // Local key on the environments table...
        )->orderByDesc('created_at')->take(4);
    }

    public function products(){
        return $this->hasManyThrough(
            Product::class,
            ProductToServiceCategory::class,
            'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'product_id' // Local key on the environments table...
        );
    }

    public function exams(){
        return $this->hasManyThrough(
            Exam::class,
            ExamToServiceCategory::class,
            'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'exam_id' // Local key on the environments table...
        )->orderByDesc('created_at');
        //->take(3)
    }

    public function service(){
        return $this->hasOneThrough(Service::class, service_To_Scategory::class, 'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'service_id' // Local key on the environments table...
        );
    }

    public function getPodcastsAndVideosAttribute(){

        $podcasts = collect($this->podcasts()->get());
        $videos = collect($this->videos()->get());

        return $podcasts->concat($videos)->take(4)->sortByDesc('created_at')->values()->all();
    }

}
