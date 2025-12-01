<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    protected $table = 'order_items';
    public $incrementing = true;
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withDefault([
                'name' => $this->product_name
            ]);
    }
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billing_address()
    {
        return $this->hasOne(OrderAddress::class, 'order_item_id', 'id')->where('type', 'billing');
    }

    public function shipping_address()
    {
        return $this->hasOne(OrderAddress::class, 'order_item_id', 'id')->where('type', 'shipping');
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
