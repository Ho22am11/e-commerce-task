<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class OrderPaid implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;
    public $order;

    public function __construct( $order)
    {
        $this->message = " Order has been paid successfully";
        $this->order = $order ;
    }


    public function broadcastAs()
    {
        return 'order.paid';
    }


     public function broadcastOn()
    {
        return new PrivateChannel('user.' .$this->order->user_id);
    }


     public function broadcastWith()
    {
        return [
            'messages ' => 'Order has been paid successfully' ,
            'order ' => $this->order,
        ];
    }
}
