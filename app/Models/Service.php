<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model{

    protected $appends = [
        'slug',
    ];

    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->title);
    }

    public function categories(){
        return $this->hasManyThrough(Service_Category::class, service_To_Scategory::class, 'service_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'service_category_id' // Local key on the environments table...
        );
    }

    public function products(){
        return $this->hasManyThrough(Product::class, ServiceToShop::class, 'service_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'product_id' // Local key on the environments table...
        );
    }

    public function doctor(){
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function comments(){
        return $this->hasManyThrough(ClientComments::class,
            ClientCommentToServiceCategory::class,
            'service_category_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'client_comment_id' // Local key on the environments table...
        );
    }
}
