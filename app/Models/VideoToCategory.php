<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoToCategory extends Model{

    public function video(){
        return $this->hasOne(video::class , 'id' , 'video_id');
    }

}
