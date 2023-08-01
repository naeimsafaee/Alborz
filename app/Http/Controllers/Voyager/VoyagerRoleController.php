<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerRoleController as BaseVoyagerRoleController;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Permission;
class VoyagerRoleController extends BaseVoyagerRoleController
{
  public function store(Request $request)
  {
      $ides = [];
      if(is_array($request->permissions) && count($request->permissions)){
        $perms = Permission::find($request->permissions);
        foreach($perms as $permission){
          if(auth()->user()->role->type == 1 && !auth()->user()->hasPermission($permission->key))
            continue;
          $ides[] = $permission->id;
        }
      }
      $request->merge([
        'type' => auth()->user()->role->type == 1 && $request->type == 0 ? 1 : $request->type,
        'permissions' => $ides
      ]);
      return parent::store($request);
  }
  public function update(Request $request,$id)
  {
      $ides = [];
      if(is_array($request->permissions) && count($request->permissions)){
        $perms = Permission::find($request->permissions);
        foreach($perms as $permission){
          if(auth()->user()->role->type == 1 && !auth()->user()->hasPermission($permission->key))
            continue;
          $ides[] = $permission->id;
        }
      }
      $request->merge([
        'type' => auth()->user()->role->type == 1 && $request->type == 0 ? 1 : $request->type,
        'permissions' => $ides
      ]);
      return parent::update($request,$id);
  }
}
