<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedExam extends Model{

    protected $fillable = ['exam_id' , 'client_id' , 'code' , 'weight'];

}
