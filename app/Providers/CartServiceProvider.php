<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\card\CardRepositories;
use App\Repositories\card\CardModelRepositories;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CardRepositories::class, function () {
            return new CardModelRepositories();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
