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
                return $can || $request->user()->hasPermissionTo($perm);
            });

            if(!$hasAnyPermission)
            {
                if ($request->ajax())
                {
                  return response()->json(['error' => 'Unauthorized'], 403);
                }

                abort(403);
            }
        } else
        {
            if(!$request->user()->hasRole($role))
            {
                if ($request->ajax())
                {
                  return response()->json(['error' => 'Unauthorized'], 403);
                }

                abort(403);
            }
        }

        return $next($request);
    }
}
