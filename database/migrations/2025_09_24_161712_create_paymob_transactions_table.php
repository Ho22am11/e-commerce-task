<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paymob_transactions', function (Blueprint $table) {
            $table->id();
            
            $table->string('transaction_id')->nullable();
            $table->string('merchant_order_id')->nullable();
            $table->string('paypal_order_id')->nullable();
            $table->string('currency')->nullable();
            $table->integer('amount_cents')->nullable();
            $table->boolean('success')->default(false);
            $table->string('source_data_type')->nullable();
            $table->string('source_data_pan')->nullable();
            $table->string('source_data_sub_type')->nullable();
            $table->string('txn_response_code')->nullable();
            $table->json('raw_response')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('paymob_transactions');
    }
};
