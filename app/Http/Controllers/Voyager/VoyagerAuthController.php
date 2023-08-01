<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{
  public function login()
  {

      if ($this->guard()->user()) {
          if($this->guard()->user()->role->redirectroute !='')
            return redirect($this->guard()->user()->role->redirectroute);
          else
            return redirect()->route('voyager.dashboard');
      }

      return view('voyager::login');
  }
  public function redirectTo()
  {

      if($this->guard()->user()->role->redirectroute !='')
        return $this->guard()->user()->role->redirectroute;
      else
      return config('voyager.user.redirect', route('voyager.dashboard'));
  }

}
