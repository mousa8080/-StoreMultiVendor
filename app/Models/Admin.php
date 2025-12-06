<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;



class Admin extends User
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'username',
        'password',
        'status',
        'super_admin'
    ];
}
