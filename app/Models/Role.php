<?php

namespace App\Models;

class Role extends \TCG\Voyager\Models\Role
{
    public function scopeAdminLevel($query)
    {
        if (auth()->user()->role->type == 1) {
            return $query->where('id', '!=', 1)->where('id', '!=', auth()->user()->role->id);
        } else {
            return $query;
        }

    }
}
