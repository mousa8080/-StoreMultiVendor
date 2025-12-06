<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $order_id
 * @property int|null $product_id
 * @property string $product_name
 * @property float $price
 * @property int $quantity
 * @property string|null $options
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderAddress> $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\OrderAddress|null $billing_address
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\OrderAddress|null $shipping_address
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereQuantity($value)
 * @mixin \Eloquent
 */
class OrderItem extends Pivot
{
    protected $table = 'order_items';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'options',
    ];

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
