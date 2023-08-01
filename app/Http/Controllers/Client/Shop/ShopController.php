<?php

namespace App\Http\Controllers\Client\Shop;

use App\Http\Controllers\Controller;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\ProductToHeading;
use Illuminate\Http\Request;

class ShopController extends Controller{
    public function __invoke($slug){
        $slug = str_replace("_", " ", urldecode($slug));
        $product = Product::query()->where('name', '=', $slug)->first();
        $video_path = $product->main_video;
        $is_buy = false;

        if ($product->price == 0 && count($product->prerequisites) == 0){
            $is_buy = true;
        }

        if(auth()->guard('clients')->check()){
            $check = ClientProduct::query()->where('product_id', '=', $product->id)->where('client_id', '=', auth()->guard('clients')->user()->id)->get();
            if($check->count() > 0)
                $is_buy = true;
        }

        return view('client.shop.shop', compact('product', 'video_path', 'is_buy'));
    }
}
