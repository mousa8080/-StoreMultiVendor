<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TowFactorAuthenticationController extends Controller
{
    public function showTwoFactorAuthenticationForm()
    {
        return view('front.auth.tow-factor-auth');
    }
}
