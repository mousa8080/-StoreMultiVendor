<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Observers\CardObserver;

class Card extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];
    public static function booted()
    {
        static::observe(CardObserver::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(
            [
                'name' => 'guest',
            ],
        );
    }
}
