<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

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
    // Menampilkan halaman setelah pembayaran dilakukan
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

    // Melakukan pembayaran melalui Midtrans
    public function pay(Request $request)
    {
        $paymentData = json_decode($request->result_data);
        $paymentStatus = $paymentData->transaction_status;

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
}