<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banneduser extends Model
{
    protected $fillable = [
        'user_id', 'byuser_id', 'supportmessage_id', 'reason',
    ];
    public function message()
    {
        return $this->belongsTo('App\Models\Supportmessage', 'supportmessage_id');
    }
}
