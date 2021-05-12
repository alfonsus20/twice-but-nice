<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = "shippings";
    private $curl;

    public function __construct()
    {
        $this->curl =  curl_init();
    }

    public function getCurlResult($url, $method, $post_query = "")
    {
        curl_setopt_array($this->curl, $method === "GET" ? array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/" . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                "key: " . env("RAJA_ONGKIR_KEY")
            )
        ) : array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/" . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post_query,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . env("RAJA_ONGKIR_KEY")
            )
        ));
        $response = curl_exec($this->curl);
        $err = curl_error($this->curl);
        $res = ['response' => $response, 'err' => $err];
        curl_close($this->curl);
        return $res;
    }

    public function getProvince($id = "")
    {
        $res = [];
        if ($id) {
            $res = $this->getCurlResult("province?id=" . $id, "GET");
        } else {
            $res = $this->getCurlResult("province/", "GET");
        }
        $res = json_decode($res['response'])->rajaongkir->results;
        return $res;
    }

    public function getCity($province_id = "", $id = "")
    {
        $res = [];
        $query = http_build_query(["province" => $province_id, "id" => $id]);

        if ($id || $province_id) {
            $res = $this->getCurlResult("city?" . $query, "GET");
        } else {
            $res = $this->getCurlResult("city/", "GET");
        }
        $res = json_decode($res['response'])->rajaongkir->results;
        return $res;
    }

    public function getDeliveryCosts($origin, $destination, $weight)
    {
        $delivery_cost = [];
        $couriers = ['jne', 'pos', 'tiki'];

        foreach ($couriers as $courier) {
            $query = http_build_query(["origin" => $origin, "destination" => $destination, "weight" => $weight, "courier" => $courier]);
            $res = $this->getCurlResult("cost", "POST", $query);
            $delivery_cost[$courier] = json_decode($res['response'])->rajaongkir->results;
        }

        return $delivery_cost;
    }
}
