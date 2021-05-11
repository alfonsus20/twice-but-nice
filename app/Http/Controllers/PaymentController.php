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
        $payment = Payment::where('transaction_id',$id)->first();
        // var_dump($payment);
        if ($payment) {
            return view('payment-status', ['status' => $payment->status]);
        }else{
            return view('payment-status', ['status' => 'tidak ditemukan']);
        }
    }

    public function pay(Request $request)
    {
        $paymentData = json_decode($request->result_data);
        $paymentStatus = "";

        $transaction_status = $paymentData->transaction_status;

        if ($transaction_status == "settlement") {
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

        if ($paymentStatus == 'settlement') {
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
