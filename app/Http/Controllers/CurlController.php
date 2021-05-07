<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlController extends Controller
{
    private $curl;

    public function __construct()
    {
        $this->curl =  curl_init();
    }

    public function getCrulResult($url, $method)
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/" . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                "key: " . env("RAJA_ONGKIR_KEY")
            ),
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
            $res = $this->getCrulResult("province?id=" . $id , "GET");
        } else {
            $res = $this->getCrulResult("province/", "GET");
        }
        $res = json_decode($res['response'])->rajaongkir->results;
        return $res;
    }

    public function getCity( $province_id = "",$id ="")
    {
        $res = [];
        $query = http_build_query(["province" => $province_id,"id" => $id]);

        if ($id || $province_id) {
            $res = $this->getCrulResult("city?" . $query , "GET");
        } else {
            $res = $this->getCrulResult("city/", "GET");
        }
        $res = json_decode($res['response'])->rajaongkir->results;
        return $res;
    }
}
