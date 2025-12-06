<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Observers\CardObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

/**
 * @property string $id
 * @property string $cookie_id
 * @property int|null $user_id
 * @property int $product_id
 * @property int $quantity
 * @property string|null $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User|null $user
 * @method static Builder<static>|Card newModelQuery()
 * @method static Builder<static>|Card newQuery()
 * @method static Builder<static>|Card query()
 * @method static Builder<static>|Card whereCookieId($value)
 * @method static Builder<static>|Card whereCreatedAt($value)
 * @method static Builder<static>|Card whereId($value)
 * @method static Builder<static>|Card whereOptions($value)
 * @method static Builder<static>|Card whereProductId($value)
 * @method static Builder<static>|Card whereQuantity($value)
 * @method static Builder<static>|Card whereUpdatedAt($value)
 * @method static Builder<static>|Card whereUserId($value)
 * @mixin \Eloquent
 */
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
