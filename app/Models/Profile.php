<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'city',
        'state',
        'country',
        'postal_code',
        'locale',
        'gender',
        'birth_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
