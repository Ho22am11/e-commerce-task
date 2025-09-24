<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAttempt extends Model
{
        protected $fillable = [
        'order_id',
        'merchant_order_id',
        'paymob_order_id',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
