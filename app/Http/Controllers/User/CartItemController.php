<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', auth('user')->id())->get();

        $totalPrice = $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        });

        return api_success([
            'items' => CartResource::collection($cartItems),
            'total_price' => $totalPrice,
        ], 'Cart contents');
    }



     public function store(AddToCartRequest $request)
    {

        $userId = auth('user')->id();

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ;

        if (!$product->hasStock($quantity)) {
            return api_error('Not enough stock');
        }

        $cartItem = CartItem::firstOrCreate(
            ['user_id' => $userId, 'product_id' => $product->id],
            ['quantity' => 0]
        );

        $cartItem->increment('quantity', $quantity);


        return api_success(new CartResource($cartItem) , 'Product added to cart');
    }


     public function update(Request $request, $id)
    {
        $cartItem = CartItem::where('user_id', auth('user')->id())->where('product_id', $id)->first();
        $quantity = $request->quantity;

        $product = $cartItem->product;

        if (!$product->hasStock($quantity)) {
            return api_error('Not enough stock');
        }

        $cartItem->update(['quantity' => $quantity]);

        return api_success(new CartResource($cartItem), 'Cart item updated');
    }



    

      public function destroy($id)
    {
        $cartItem = CartItem::where('user_id', auth('user')->id())->where('product_id', $id)->first();
        $cartItem->delete();

        return api_success('Cart item removed');
    }
}
