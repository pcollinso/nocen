<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OptionsService;
use App\Services\BatchService;
use App\Services\InstitutionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OptionsService::class, OptionsService::class);
        $this->app->bind(BatchService::class, BatchService::class);
        $this->app->bind(InstitutionService::class, InstitutionService::class);
    }
}
