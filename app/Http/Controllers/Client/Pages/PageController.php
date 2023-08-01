<?php

namespace App\Http\Controllers\Client\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Prerequisites;
use App\Models\Product;
use App\Notifications\SendSMS;
use App\ProductOneUsed;
use Illuminate\Http\Request;

class PageController extends Controller{

    public function __invoke($page){
        $page = Page::query()->where('slug', $page)->firstOrFail();
        return view('client.pages.pages', compact('page'));
    }

    public function send_sms(Request $request){

        $client_id = $request->client_id;
        $exam_id = $request->exam_id;

        $client = \App\Models\Client::query()->findOrFail($client_id);

        return view('vendor.voyager.answer_send.edit-add' , compact('client_id' , 'exam_id'));
    }

    public function send_sms_submit(Request $request){

        $client_id = $request->client_id;
        $exam_id = $request->exam_id;

        $client = \App\Models\Client::query()->findOrFail($client_id);

        $product = Prerequisites::query()->where('exam_id' , $exam_id)->first();
        if(!$product)
            return;

        $link = $this->generateRandomString();

        ProductOneUsed::query()->create([
            'product_id' => $product->product_id,
            'link' => $link
        ]);


//        $link = route('buy_product_with_link' , $link);

        /*$message = "کاربر گرامی مرکز گفتاردرمانی البرز آترا
نتایج ارزیابی شما بر روی پروفایل کاربریتان قرار گرفت.
در صورت تمایل می توانید پکیج درمانی آفلاین تعاملی خود را از لینک $link خریداری بفرمایید.";*/

        $message = $request->message/* . PHP_EOL . $link*/;

        $client->notify(new SendSMS($client->phone, $message , "clivia"));

        return redirect('/admin');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
