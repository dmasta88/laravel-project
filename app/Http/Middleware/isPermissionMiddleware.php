<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = auth('api')->user()->roles;
        $routeName = $request->route()->getName();
        [$resource, $action] = explode('.', $routeName);

        if ($roles->contains('title', 'admin')) {
            return $next($request);
        }
        if (!$roles->contains('title', 'moderator_' . $resource)) {
            return response(['message' => "You are not {$resource} moderator"], Response::HTTP_FORBIDDEN);
        }
        $permissions = $roles->flatMap->permissions;

        if (!$permissions->contains('title', $action)) {
            return response(['message' => "You don't have permission for {$action}"], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
