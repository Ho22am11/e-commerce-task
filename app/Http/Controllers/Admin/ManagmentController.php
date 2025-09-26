<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaginationResource;
use App\Models\Order;
use Illuminate\Http\Request;

class ManagmentController extends Controller
{
    public function getOrders() {

        $orders = Order::latest()->paginate(20);

        return api_success([
            'orders'   => OrderResource::collection($orders) ,
            'pagination' => new PaginationResource($orders),
        ], 'orders retrieved successfully');

    }
}
