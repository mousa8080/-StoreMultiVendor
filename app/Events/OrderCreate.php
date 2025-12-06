<?php

namespace App\Events;

use App\Models\Order;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // Find the user who owns this store to send them the notification
        $user = User::where('store_id', $this->order->store_id)->first();

        if ($user) {
            return [
                new PrivateChannel('App.User.' . $user->id),
            ];
        }

        return [];
    }

    public function broadcastWith(): array
    {
        $addr = $this->order->billingAddress;
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->number,
            'message' => "طلب جديد #{$this->order->number} من {$addr->name}",
            'total' => $this->order->total,
            'customer_name' => $addr->name,
        ];
    }
}
