<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $appends = ['slug'];
    public function getSlugAttribute(){
        return str_replace(" ", "_", $this->full_name);
    }
}
