<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AllProductController extends Controller{

    public function __invoke(){

        $product = Product::query()->orderBy('created_at')->paginate(12);

        return view('client.pages.all_products' , compact('product'));
    }
}
