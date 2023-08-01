<?php

namespace App\Http\Controllers\Client\Shop;

use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\Product;
use Illuminate\Http\Request;

class SingleShopController extends Controller{

    public function __invoke($shop_id, $id){
        $product = Product::query()->where('id', '=', $shop_id)->firstOrFail();
        $heading = Heading::query()->where('id', '=', $id)->firstOrFail();
        $video_path = $heading->video;
        return view('client.shop.single_shop', compact('heading', 'product', 'video_path'));
    }

}