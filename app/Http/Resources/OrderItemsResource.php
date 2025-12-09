<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => [
                'id' => $this->order_id,
                'user_id' => $this->order->user_id,
                'store_id' => $this->order->store_id,
                'store_name' => $this->order->store->name,
                'status' => $this->order->status,


            ],
            'product' => [
                'product_id' => $this->product_id,
                'product_name' => $this->product->name,

            ],
            'order_item_price' => $this->price,
            'quantity' => $this->quantity,
            'options' => $this->options,

        ];
    }
}
