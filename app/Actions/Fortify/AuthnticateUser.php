<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthnticateUser
{
    public function authenticate($request)
    {

        $username = $request->POST(config('fortify.username'));
        $password = $request->POST('password');

        $user_admin = Admin::where('email', $username)
            ->orWhere('phone_number', $username)
            ->orWhere('username', $username)
            ->first();

        if ($user_admin &&  Hash::check($password, $user_admin->password)) {
            return $user_admin;
        }
        return null;
    }
}
