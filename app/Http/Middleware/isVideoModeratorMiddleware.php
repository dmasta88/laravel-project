<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isVideoModeratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            if ($role->title !== 'moderator_videos') {
                return response(['message' => 'You are not video moderator'], Response::HTTP_FORBIDDEN);
            }
        }
        dd($request->route()->getName());
        return $next($request);
    }
}
