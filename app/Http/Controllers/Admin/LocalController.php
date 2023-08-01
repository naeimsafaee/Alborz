<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Session;

class LocalController extends Controller
{
    public function setLocale($lang)
    {
        $langs = ['en', 'fa'];
        if (in_array($lang, $langs)) {
            Session(['locale' => $lang]);
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'out of range'];
        }
    }
}
