<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\ProductSeed;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddCardTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_to_card()
    {
        $this->seed(UserSeeder::class);

        $user = User::first();

        $token = auth('user')->login($user);

        $user = auth('user')->user();
        $user->token = $token ;

        $this->seed(ProductSeed::class);


        $product = Product::first();


        $response = $this->actingAs($user)->postJson('/api/carts', [
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);


        $response->assertStatus(200)
        ->assertJson([
            'is_success'  => true,
            'status_code' => 200,
            'message'     => 'Product added to cart',
        ]);
    }
    
}
