<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supportmessage extends Model
{
    protected $fillable = ['support_id', 'user_id', 'client_id', 'message'];
}
