<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayPlusController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function createdTransaction(Request $request)
    {
        $req = $request->except('_token');
        $resp = (new Transaction)->create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        return view('checkout/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitTransaction(Request $request)
    {
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $resp = (new Transaction)->commit($req["token_ws"]);

            return view('checkout/transaction_committed', ["resp" => $resp, 'req' => $req]);
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
