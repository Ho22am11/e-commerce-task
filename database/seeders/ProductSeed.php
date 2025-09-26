<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{

    public function run(): void
    {

        $products = [
            [
                'name' => 'Laptop Lenovo ThinkPad',
                'description' => 'Business laptop with Intel i7, 16GB RAM, and 512GB SSD.',
                'price' => 1500.00,
                'stock_quantity' => 10,

            ],
            [
                'name' => 'iPhone 14 Pro',
                'description' => 'Latest Apple iPhone with A16 Bionic chip and ProMotion display.',
                'price' => 1200.00,
                'stock_quantity' => 15,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Noise-canceling wireless headphones with premium sound quality.',
                'price' => 350.00,
                'stock_quantity' => 30,
            ],
            [
                'name' => 'Samsung 4K Smart TV',
                'description' => '55-inch UHD Smart TV with HDR and streaming apps built-in.',
                'price' => 800.00,
                'stock_quantity' => 8,
            ],
            [
                'name' => 'Logitech MX Master 3 Mouse',
                'description' => 'Advanced wireless mouse with ergonomic design and fast scrolling.',
                'price' => 100.00,
                'stock_quantity' => 50,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

    }
}
