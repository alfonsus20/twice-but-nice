<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentStatus($id)
    {
        $status = 'tidak ditemukan';
        $payment = Payment::where('transaction_id', $id)->first();
        if ($payment) {
            if ($payment->status == Payment::SETTLEMENT || $payment->status == Payment::CAPTURE) {
                $status = 'sukses';
            } else if ($payment->status === Payment::PENDING) {
                $status = 'tertunda';
            } else {
                $status = 'gagal';
            }
        }
        return view('payment-status', ['status' => $status]);
    }

    public function pay(Request $request)
    {
        $paymentData = json_decode($request->result_data);
        $paymentStatus = "";

        $transaction_status = $paymentData->transaction_status;

        if ($transaction_status == "capture") {
            $paymentStatus = Payment::CAPTURE;
        } else if ($transaction_status == "settlement") {
            $paymentStatus = Payment::SETTLEMENT;
        } else if ($transaction_status == 'pending') {
            $paymentStatus = Payment::PENDING;
        } else if ($transaction_status == 'deny') {
            $paymentStatus = PAYMENT::DENY;
        } else if ($transaction_status == 'expire') {
            $paymentStatus = PAYMENT::EXPIRE;
        } else if ($transaction_status == 'cancel') {
            $paymentStatus = PAYMENT::CANCEL;
        }

        $payment = new Payment;
        $payment->transaction_id = $paymentData->transaction_id;
        $payment->order_id = $paymentData->order_id;
        $payment->type = $paymentData->payment_type;
        $payment->status = $paymentData->transaction_status;
        $payment->save();

        if ($paymentStatus == 'settlement' || $paymentStatus == 'capture') {
            $order = Order::find($paymentData->order_id);
            $order->paid = true;
            $order->save();
        }
        return redirect('/after-payment/' . $paymentData->transaction_id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getPaymentData($order_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $order_id . '/status',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . base64_encode(env("MIDTRANS_SERVER_KEY"). ":")
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        return json_decode($response);
    }

    public function finish(Request $request)
    {
    }

    public function unfinish(Request $request)
    {
    }

    public function failed(Request $request)
    {
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}