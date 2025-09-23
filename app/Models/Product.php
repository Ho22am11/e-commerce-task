<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
    ];

     public function hasStock(int $quantity): bool
    {
        return $this->stock_quantity >= $quantity;
    }
}
