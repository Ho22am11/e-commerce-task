<?php

namespace App\Services ;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

Class OrderService {

    public function store(){

        $userId = auth('user')->id();

        $cartItems = CartItem::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return NULL ;
        }

        $order = Order::create([
            'user_id' => $userId ,
        ]); 

        $total = 0 ;

        foreach ($cartItems as $item) {

            $product = Product::find($item->product_id);

            if (!$product->hasStock($item->quantity)) {
                return api_error($product->name.' Not enough stock');
            }


            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $item->quantity,
                'price'      => $product->price,
            ]);


            $product->decrement('stock_quantity', $item->quantity);

            $lineTotal = $item->quantity * $product->price;
            $total += $lineTotal;


        }


        $order->update(['total' => $total]);

        CartItem::where('user_id', $userId)->delete();

        $order->load('orderItems.product');

        return $order ;

    }

}
