<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\ProductSeed;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout()
    {
        $this->seed(UserSeeder::class);
        $user = User::first();
        $token = auth('user')->login($user);

        $user->token = $token ;

        $this->seed(ProductSeed::class);
        $product = Product::first();

        $product->update(['stock_quantity' => 10]);



        $this->actingAs($user)->postJson('/api/carts', [
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);

        $response = $this->actingAs($user)->postJson('/api/checkout');


        
        }
}
