<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personalizemenu extends Model
{
    protected $fillable = ['data'];
    protected $casts = [
        'data' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
