<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Models\Card;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Pest\Mutate\Mutators\ControlStructures\ForeachEmptyIterable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreate $order): void
    {
        foreach ($order->order->products as $product) {
            $product->decrement('quantity', $product->pivot->quantity);
        }

        // foreach (Card::get() as $item) {
        //     $item->product->quantity -= $item->quantity;
        //     $item->product->save();
        // }
    }
}
