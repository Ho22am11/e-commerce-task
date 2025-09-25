<?php

namespace App\Services ;

use App\Models\PaymentAttempt;
use App\Models\PaymobTransaction;

Class HandleService {

    public function handle($request){

        $data = $request->all();

        PaymobTransaction::create([
            'transaction_id'       => $data['id'] ?? null,
            'paypal_order_id'      => $data['order'] ?? null,
            'merchant_order_id'   => $data['merchant_order_id'] ?? null,
            'currency'             => $data['currency'] ?? null,
            'amount_cents'         => $data['amount_cents'] ?? null,
            'success'              => filter_var($data['success'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'source_data_type'     => $data['source_data_type'] ?? null,
            'source_data_pan'      => $data['source_data_pan'] ?? null,
            'source_data_sub_type' => $data['source_data_sub_type'] ?? null,
            'txn_response_code'    => $data['txn_response_code'] ?? null,
            'raw_response'         => json_encode($data),
        ]);

        $attempt = PaymentAttempt::where('merchant_order_id', $data['merchant_order_id'] ?? null)->first();
        $attempt->update([
            'status' => 'pended'
        ]);
        $attempt->save();

    }

}
