<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model{

    public function morph(){
        return $this->hasMany(MetaMorph::class , 'meta_id' , 'id');
    }

}
