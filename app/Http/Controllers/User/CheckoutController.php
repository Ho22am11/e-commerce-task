<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentAttempt;
use App\Models\PaymobTransaction;
use App\Models\Product;
use App\Services\HandleService;
use App\Services\OrderService;
use App\Services\PaymentServices;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request , OrderService $order_service , PaymentServices $payment){

        $order = $order_service->store();

        if (!$order) {
            return api_error('Cart is empty');
        }

        $paymentUrl = $payment->pay($order);

        return api_success([
            "order" => new OrderResource($order),
            "payment_url" => $paymentUrl
        ], 'Checkout completed successfully');

    }


      public function handle(Request $request , HandleService $handle_service){

        $handle_service->handle($request);
     }
}
