<?php

use App\Events\OrderPaid;
use App\Http\Controllers\Admin\ProductControlller;
use App\Http\Controllers\User\AuthControlller;
use App\Http\Controllers\User\CartItemController;
use App\Http\Controllers\User\CheckoutController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\Admin\ManagmentController;

Route::post('register' , [AuthControlller::class , 'register']);
Route::post('login', [AuthControlller::class , 'login']);



Route::middleware(['auth:admin,user'])->group(function () {
    Route::post('logout', [AuthControlller::class , 'logout']);
    Route::resource('carts', CartItemController::class);
    Route::post('checkout', [CheckoutController::class , 'checkout']);
    Route::get('prodects', [ProductControlller::class , 'index']);
});




Route::post('admin/login', [AuthController::class , 'login']);

Route::middleware('admin')->group(function () {
    Route::resource('prodects', ProductControlller::class)->except('index');
    Route::get('orders', [ManagmentController::class , 'getOrders']);


});







Route::match(['GET', 'POST'], '/paymob/webhook', [CheckoutController::class, 'handle'])
    ->name('paymob.webhook');
