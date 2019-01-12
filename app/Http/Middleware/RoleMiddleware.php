<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, ... $permissions)
    {
        if (count($permissions))
        {
            // Check if the user has any of the listed permissions
            $hasAnyPermission = array_reduce($permissions, function ($can, $perm) use ($request) {
                return $can || $request->user()->can($perm);
            });

            if(!$hasAnyPermission)
            {
                abort(404);
            }
        } else
        {
            if(!$request->user()->hasRole($role))
            {
                abort(404);
            }
        }

        return $next($request);
    }
}
