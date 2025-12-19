<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie as Cookies;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            if ($user->super_admin) {
                return true;
            }
        });

        foreach(config('abilits') as $code => $label){
            Gate::define($code, function ($user) use ($code) {
                return $user->hasAbilities($code);
            });
        }
        
       



        Validator::extend('filter', function ($attribute, $value, $params) {
            return  !in_array(strtolower($value), $params);
        }, 'this name is forbidden!');
        Paginator::useBootstrap();
        // Paginator::defaultView('pagination.custom');
    }
}
