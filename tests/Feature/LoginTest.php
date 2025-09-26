<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; 

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_seeded_user()
    {
        $this->seed(UserSeeder::class);

        $user = User::first();

        $response = $this->postJson('/api/login', [
            'email' => 'user@gmailcom',
            'password' => '123456',
        ]);

        $response->assertStatus(200);
    }
}
