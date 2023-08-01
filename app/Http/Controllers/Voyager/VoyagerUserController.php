<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerUserController as BaseVoyagerUserController;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;

class VoyagerUserController extends BaseVoyagerUserController
{
  public function store(Request $request)
  {
      $role = Role::find($request->role_id);

      if(($role->exists() && $role->type!=0 && auth()->user()->role->type == 1) || auth()->user()->role->type == 0)
        $role_id = $request->role_id;

      $request->merge([
        'role_id' => $role_id,
        'user_belongstomany_role_relationship' => auth()->user()->role->type == 0 ? $request->user_belongstomany_role_relationship : []
      ]);
      return parent::store($request);
  }
  public function update(Request $request,$id)
  {
      $role = Role::find($request->role_id);

      $role_id = User::find($id)->role ? User::find($id)->role->id : null;

      if(($role->exists() && $role->type!=0 && auth()->user()->role->type == 1) || auth()->user()->role->type == 0)
        $role_id = $request->role_id;

      $request->merge([
        'role_id' => $role_id,
        'user_belongstomany_role_relationship' => auth()->user()->role->type == 0 ? $request->user_belongstomany_role_relationship : []
      ]);
      return parent::update($request,$id);
  }
}
