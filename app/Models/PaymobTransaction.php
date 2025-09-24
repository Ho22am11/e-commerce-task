<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymobTransaction extends Model
{
     protected $fillable = [
        'transaction_id',
        'merchant_order_id',
        'paypal_order_id',
        'currency',
        'amount_cents',
        'success',
        'source_data_type',
        'source_data_pan',
        'source_data_sub_type',
        'txn_response_code',
        'raw_response',
    ];
}
