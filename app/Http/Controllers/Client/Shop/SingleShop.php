<?php

namespace App\Http\Controllers\Client\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleShop extends Controller
{
    public function __invoke(Request $request)
    {
        return view('client.shop.single_shop');
    }
}