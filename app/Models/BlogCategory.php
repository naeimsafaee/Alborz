<?php

namespace App\Models;

use App\Models\video;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model{
    protected $appends = [
        'slug',
    ];

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }

    public function videos(){
        return $this->hasManyThrough(video::class, VideoToCategory::class, 'category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'video_id' // Local key on the environments table...
        );
    }

    public function podcasts(){
        return $this->hasManyThrough(podcast::class, PodcastToCategory::class, 'category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'podcast_id' // Local key on the environments table...
        );
    }

    public function blogs(){
        return $this->hasManyThrough(Blog::class, BlogToCategory::class, 'category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'blog_id' // Local key on the environments table...
        );
    }
}
