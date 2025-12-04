<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id',
        'user_id',
        'number',
        'payment_method',
        'status',
        'payment_status',
        'shipping',
        'tax',
        'discount',
        'total',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest user',
        ]);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->withPivot([
                'price',
                'quantity',
                'options'
            ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 'shipping');
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->number = Order::getNextOrdernumber();
        });
    }
    public static function getNextOrdernumber()
    {
        // $number = self::whereYear('created_at', $year)->max('number');
        // if ($number) {
        //     return $year . '-' . $number + 1;
        // }
        // return $year . '-0001';



        $year = Carbon::now()->year;
        $count = self::whereYear('created_at', $year)->count();
        $nextNumber = $count + 1;

        return $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
