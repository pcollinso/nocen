<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\CustomUserProvider;

class CustomAuthProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->provider('custom', function ($app, array $config) {
            return new CustomUserProvider($app['hash'], $app['config']['auth.providers.users.model']);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      //
    }
}
