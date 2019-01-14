<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gate;
use Blade;
use App\Models\Permission;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Permission::get()->map(function($permission) {
            Gate::define($permission->name, function($user) use ($permission) {
               return $user->hasPermissionTo($permission);
            });
        });

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) :";
        });
        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });

        Blade::directive('permission', function ($permission) {
            return "<?php if(auth()->check() && auth()->user()->hasPermission({$permission})) :";
        });
        Blade::directive('endpermission', function ($role) {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
