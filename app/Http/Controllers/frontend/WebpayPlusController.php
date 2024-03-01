<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

use Illuminate\Support\Facades\Http;

class WebpayPlusController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    //Old Transaction
    // public function createdTransaction(Request $request)
    // {
    //     $req = $request->except('_token');
    //     $resp = (new Transaction)->create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

    //     return view('checkout/transaction_created', [ "params" => $req,"response" => $resp]);
    // }

    // public function createdTransaction(Request $request)
    // {
    //     $req = $request->except('_token');

    //     // Create the transaction
    //     $transaction = new Transaction;
    //     $resp = $transaction->create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

    //     // Redirect to the payment page
    //     return redirect()->away($resp->getUrl());
    // }

    //Other approach 
    public function createdTransaction(Request $request)
    {
        $req = $request->except('_token');

        // Create the transaction
        $transaction = new Transaction;
        $resp = $transaction->create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        // Prepare the URL with token as query parameter
        $paymentUrl = $resp->getUrl() . '?token_ws=' . $resp->getToken();

        // Make a GET request to the payment gateway URL with the token
        $response = Http::get($paymentUrl);

        // Check if the request was successful
        if ($response->successful()) {
            // Process the response if needed
            return $response->body();
        } else {
            // Handle the case when the request fails
            return back()->withError('Failed to redirect to payment gateway.');
        }
    }


    //Return URL
    public function commitTransaction(Request $request)
    {
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $resp = (new Transaction)->commit($req["token_ws"]);

            // return view('checkout/transaction_committed', ["resp" => $resp, 'req' => $req]);
            return view('order_end', ["resp" => $resp, 'req' => $req]);
        }

        //Pago abortado
        if($request->exists("TBK_TOKEN")){
            return view('checkout/transaction_aborted', ["resp" => $request->all()]);
        }

        //Timeout
        return view('checkout/transaction_timeout', ["resp" => $request->all()]);

    }


    public function showRefund()
    {
        return view('checkout/refund');
    }

    public function refundTransaction(Request $request)
    {
        $error = false;
        try {
            $req = $request->except('_token');
            $resp = (new Transaction)->refund($req["token"], $req["amount"]);
        } catch (\Exception $e) {
            $resp = array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            );
            $error = true;
        }
        return view('checkout/refund_success', ["resp" => $resp, "error" => $error]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new Transaction)->status($token);
        return view('checkout/transaction_status', ["resp" => $resp, "req" => $req]);
    }
}
