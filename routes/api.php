<?php

use App\Http\Controllers\Admin\ProductControlller;
use App\Http\Controllers\User\AuthControlller;
use App\Http\Controllers\User\CartItemController;
use App\Http\Controllers\User\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register' , [AuthControlller::class , 'register']);
Route::post('login', [AuthControlller::class , 'login']);
Route::post('logout', [AuthControlller::class , 'logout']);

Route::resource('prodects' , ProductControlller::class);

Route::resource('carts', CartItemController::class);

Route::post('checkout' , [CheckoutController::class , 'checkout']);



Route::match(['GET', 'POST'], '/paymob/webhook', [CheckoutController::class, 'handle'])
    ->name('paymob.webhook');



