<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Observers\CardObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

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
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('card_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('card_id', $cookie_id, 60 * 60 * 24 * 30);
        }

        return $cookie_id;
    }
    public static function booted()
    {
        static::observe(CardObserver::class);
        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', '=', Card::getCookieId());
        });
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
