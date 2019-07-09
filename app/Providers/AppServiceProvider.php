<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OptionsService;
use App\Services\BatchService;
use App\Services\InstitutionService;
use App\Services\ModuleService;
use App\Services\SubjectService;
use App\Services\GradeAService;
use App\Services\ActionHistoryService;
use App\Services\CourseService;
use App\Providers\CustomUserProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $user_type = auth()->user() ? auth()->user()->user_type : 'guest';
            $name = auth()->user() ? auth()->user()->full_name : 'Guest User';
            $roles = auth()->user() ? auth()->user()->roles()->get() : [];
            $permissions = auth()->user() ? auth()->user()->permissions()->get() : [];
            $pageTitle = $view->pageTitle ? $view->pageTitle : 'Default';
            $view->with('currentUserName', $name);
            $view->with('currentRoles', $roles);
            $view->with('currentPermissions', $permissions);
            $view->with('pageTitle', $pageTitle);
            $view->with('currentUserType', $user_type);
        });
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
        $this->app->bind(ModuleService::class, ModuleService::class);
        $this->app->bind(SubjectService::class, SubjectService::class);
        $this->app->bind(GradeAService::class, GradeAService::class);
        $this->app->bind(ActionHistoryService::class, ActionHistoryService::class);
        $this->app->bind(CourseService::class, CourseService::class);
        $this->app->bind(CustomUserProvider::class, function ($app, array $config) {
            return new CustomUserProvider($app['hash'], $app['config']['auth.providers.users.model']);
        });
    }
}
