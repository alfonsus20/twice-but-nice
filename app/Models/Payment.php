<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected  $primaryKey = 'transaction_id';
    public const CAPTURE = 'capture';
    public const SETTLEMENT = 'settlement';
    public const PENDING = 'pending';
    public const DENY = 'deny';
    public const EXPIRE = 'expire';
    public const CANCEL = 'cancel';

    // Mendapatkan status pembayaran terbaru dari API Midtrans
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
                "Authorization: " . base64_encode(env("MIDTRANS_SERVER_KEY") . ":")
            )
        ));
        $response = curl_exec($curl);
        return json_decode($response);
    }
}
