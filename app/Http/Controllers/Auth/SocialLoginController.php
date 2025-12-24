<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Throwable;
class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
            // $user = User::where([
            //    'provider_id' => $providerUser->id,
            //    'provider' => $provider
            // ])->firstOrCreate([
            //     'name' => $providerUser->name,
            //     'email' => $providerUser->email,
            //     'provider_id' => $providerUser->id,
            //     'provider' => $provider
            // ])->login();

            $user = User::where([
                'provider_id' => $providerUser->id,
                'provider' => $provider
            ])->first();
            if (!$user) {
                $user = User::create([
                    'name' => $providerUser->name,
                    'email' => $providerUser->email,
                    'password' => Hash::make(Str::random(10)),
                    'provider_id' => $providerUser->id,
                    'provider' => $provider,
                    'provider_token' => $providerUser->token,
                ]);
            }
            Auth::login($user);
            return redirect()->route('home');
        } catch (Throwable $e) {
            return redirect()->route('login')
            ->withErrors([
                'email'=>$e->getMessage()
            ])
            ->with('error', 'Something went wrong');
        }
    }
}
