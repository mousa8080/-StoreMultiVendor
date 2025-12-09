<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number_order' => $this->number,
            'payment_metod' => $this->payment_method,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'shipping' => $this->shipping,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'total' => $this->total,
            'store' => [
                'store_name' => $this->store->name,
                'store_id' => $this->store->id,
            ],
            'user' => [
                'user_name' => $this->user->name,
                'user_id' => $this->user->id,
            ],
        ];
    }
}
