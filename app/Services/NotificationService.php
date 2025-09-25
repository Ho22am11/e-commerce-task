<?php

namespace App\Services ;

use App\Events\OrderPaid;
use App\Models\PaymentAttempt;

class NotificationService{

    public function send($data){

        $merchant_order_id = $data['merchant_order_id'];
        $payment_attempt = PaymentAttempt::where('merchant_order_id', $merchant_order_id)->first();

        $order = $payment_attempt->order ;

        event(new OrderPaid($order));


    }
}
