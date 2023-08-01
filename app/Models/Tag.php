<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $appends = [
        'slug'
    ];

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }

    public function blogs()
    {
        return $this->hasManyThrough(
            Blog::class,
            BlogToTag::class,
            'tag_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'blog_id' // Local key on the environments table...
        );
    }

}
