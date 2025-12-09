<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

/**
 * @property int $id
 * @property int $order_id
 * @property string $type
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string $phone_number
 * @property string $street_address
 * @property string $city
 * @property string|null $postal_code
 * @property string|null $state
 * @property string $country
 * @property-read mixed $country_name
 * @property-read mixed $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderAddress whereType($value)
 * @mixin \Eloquent
 */
class OrderAddress extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'type',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'street_address',
        'city',
        'postal_code',
        'state',
        'country',
    ];
  
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getCountryNameAttribute()
    {
        return Countries::getName($this->country);
    }
}
