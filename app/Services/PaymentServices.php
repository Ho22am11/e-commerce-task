<?php

namespace App\Services ;

use App\Models\Order;
use App\Models\PaymentAttempt;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

Class PaymentServices {

    public $api_key , $integration_id , $iframe_id;

    public function __construct()
    {
        $this->api_key = env('PAYMOB_API_KEY') ;
         $this->integration_id = env('PAYMOB_INTEGRATION_ID');
         $this->iframe_id = env('PAYMOB_IFRAME_ID');


    }

    public function pay($order){

        $payment_url = $this->paymentkey( $order->total  , $order->id );

        return $payment_url ;
    }


    private function authenticate(){
        $response = Http::post('https://accept.paymob.com/api/auth/tokens' , [
            'api_key' => $this->api_key
        ]);

        return $response->json()['token'];
    }


    private function createOrder($authToken , $price , $orderId ){

        $merchantOrderId = strtoupper(Str::random(8));




        PaymentAttempt::create([
            'order_id'          => $orderId,
            'merchant_order_id' => $merchantOrderId,
        ]);



        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders' , [
            "auth_token" => $authToken,
            "amount_cents" => $price,
            "currency" => "EGP",
            "merchant_order_id" => $merchantOrderId ,
            "items" => []
        ]);

        $order = $response->json();

        return $order['id'];
    }

    private function paymentkey($price , $orderId){

        $authToken  = $this->authenticate() ;

        $billingData = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'phone_number' => '201234567890',
            'apartment' => 'NA',
            'floor' => 'NA',
            'street' => 'NA',
            'building' => 'NA',
            'city' => 'Cairo',
            'country' => 'EG',
            'state' => 'NA',
            'postal_code' => '12345',
        ];


        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys' ,[
            "auth_token" =>$authToken ,
            "amount_cents" => $price,
            "expiration" => 3600,
            "order_id" => $this->createOrder($authToken , $price , $orderId ),
            'billing_data' => $billingData,
            "currency" => "EGP",
            "integration_id" => $this->integration_id
        ]);



        if (!isset($response->json()['token'])) {
            throw new \Exception("Paymob error: " . json_encode($response->json()));
        }



        $paymentKey = $response->json()['token'];

        $iframeId =  $this->iframe_id ;
        $payment_url = "https://accept.paymob.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentKey}";

        return $payment_url ;
    }
    }

