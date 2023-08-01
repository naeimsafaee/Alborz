<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ClientExam;
use App\Models\ClientProduct;
use App\Models\Color;
use App\Models\DiscountCodes;
use App\Models\Exam;
use App\Models\Product;
use App\Models\Time;
use App\Models\Transaction;
use App\ProductOneUsed;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use SaeedVaziry\Payir\Exceptions\SendException;
use SaeedVaziry\Payir\Exceptions\VerifyException;
use SaeedVaziry\Payir\PayirPG;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller{

    public function buy_exam($exam_id){

        $exam = Exam::query()->findOrFail($exam_id);

//        $factor_number = rand(10000, 999999);


        $invoice = new Invoice;

        // Set invoice amount.
        $invoice->amount((int)$exam->price);
        $invoice->uuid();

        //        $factor_number = $invoice->getUuid();

        $invoice->detail(['توضیحات' => setting('cart.gate_description')]);


        return Payment::purchase($invoice, function($driver, $transactionId) use ($exam){
            // Store transactionId in database as we need it to verify payment in the future.
            Transaction::query()->create([
                'wallet_transaction_id' => $transactionId,
                "amount" => ((int)$exam->price) * 10,
                "paid" => false,
                "client_id" => auth()->guard('clients')->user()->id,
                "status" => 0,
                'count' => 1,
                'product_id' => $exam->id,
            ]);

        })->pay()->render();

        /*$payir = new PayirPG();
        $payir->amount = $exam->price * 10; // Required, Amount
        $payir->factorNumber = $factor_number; // Optional
        $payir->description = setting('cart.gate_description'); // Optional
        $payir->mobile = auth()->guard('clients')->user()->phone; // Optional, If you want to show user's saved card numbers in gateway*/

      /*  try {
//            $payir->send();

            return redirect($payir->paymentUrl);
        } catch(SendException $e){
            throw $e;
        }*/
    }

    public function verify(Request $request){
        //        return response()->json($request->all());

        try {

            $receipt = Payment::transactionId($request->trackId)->verify();

            $transaction = Transaction::query()->where('wallet_transaction_id', '=', $request->trackId)->firstOrFail();

            $transaction->status = config('Constants.SEND_STATUS.Registered');
            $transaction->paid = true;
//            $transaction->card_number = $verify["cardNumber"];
            $transaction->transaction_data = json_encode($request->all());
            $transaction->transaction_date = now();
            $transaction->save();

            if($transaction->is_product){

                $product = Product::query()->findOrFail($transaction->product_id);

                ClientProduct::query()->create([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'product_id' => $product->id,
                ]);

                return redirect()->route('shop', $product->slug);
            } else {
                $exam = Exam::query()->findOrFail($transaction->product_id);

                ClientExam::query()->create([
                    'client_id' => auth()->guard('clients')->user()->id,
                    'exam_id' => $exam->id,
                ]);

                return redirect()->route('exam', $exam->slug);
            }

            //            return $receipt->getReferenceId();

        } catch(InvalidPaymentException $exception){

            return redirect()->route('home');

        }

    }

    public function buy_product($product_id){
        $product = Product::query()->findOrFail($product_id);

        if($product->price == 0){
            ClientProduct::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'product_id' => $product->id,
            ]);

            return redirect()->route('shop', $product->slug);
        }


        $invoice = new Invoice;

        // Set invoice amount.
        $invoice->amount((int)$product->price);
        $invoice->uuid();

        //        $factor_number = $invoice->getUuid();

        $invoice->detail(['توضیحات' => setting('cart.gate_description')]);


        //        $payir = new PayirPG();
        //        $payir->amount = $product->price * 10; // Required, Amount
        //        $payir->factorNumber = $factor_number; // Optional
        //        $payir->description = setting('cart.gate_description'); // Optional
        //        $payir->mobile = auth()->guard('clients')->user()->phone; // Optional, If you want to show user's saved card numbers in gateway

        try {
            return Payment::purchase($invoice, function($driver, $transactionId) use ($product){
                // Store transactionId in database as we need it to verify payment in the future.
                Transaction::query()->create([
                    'wallet_transaction_id' => $transactionId,
                    "amount" => ((int)$product->price) * 10,
                    "paid" => false,
                    "client_id" => auth()->guard('clients')->user()->id,
                    "status" => 0,
                    'count' => 1,
                    'product_id' => $product->id,
                    'is_product' => true,
                ]);
            })->pay()->render();

            //            return redirect($payir->paymentUrl);
        } catch(SendException $e){
            throw $e;
        }
    }

    public function buy_product_with_link($link){

        $product_one_used = ProductOneUsed::query()->where('link' , $link)->first();

        if(!$product_one_used)
            return;

        $product = Product::query()->findOrFail($product_one_used->product_id);

        if($product->price == 0){
            ClientProduct::query()->create([
                'client_id' => auth()->guard('clients')->user()->id,
                'product_id' => $product->id,
            ]);

            return redirect()->route('shop', $product->slug);
        }


        $invoice = new Invoice;

        // Set invoice amount.
        $invoice->amount((int)$product->price);
        $invoice->uuid();

        //        $factor_number = $invoice->getUuid();

        $invoice->detail(['توضیحات' => setting('cart.gate_description')]);


        //        $payir = new PayirPG();
        //        $payir->amount = $product->price * 10; // Required, Amount
        //        $payir->factorNumber = $factor_number; // Optional
        //        $payir->description = setting('cart.gate_description'); // Optional
        //        $payir->mobile = auth()->guard('clients')->user()->phone; // Optional, If you want to show user's saved card numbers in gateway

        try {
            return Payment::purchase($invoice, function($driver, $transactionId) use ($product){
                // Store transactionId in database as we need it to verify payment in the future.
                Transaction::query()->create([
                    'wallet_transaction_id' => $transactionId,
                    "amount" => ((int)$product->price) * 10,
                    "paid" => false,
                    "client_id" => auth()->guard('clients')->user()->id,
                    "status" => 0,
                    'count' => 1,
                    'product_id' => $product->id,
                    'is_product' => true,
                ]);
            })->pay()->render();

            //            return redirect($payir->paymentUrl);
        } catch(SendException $e){
            throw $e;
        }
    }

}
