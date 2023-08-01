<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestResult extends Model{

    protected $fillable = ['exam_id' , 'client_id' , 'rate' , 'answer'];

}
