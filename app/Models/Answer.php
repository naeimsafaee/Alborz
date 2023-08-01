<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model{

    protected $fillable = ['question_id' , 'client_id' , 'file' , 'answer' , 'weight' , 'exam_id'];

}
