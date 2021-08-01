<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $method = $request->getMethod();
        $role = Role::getRoles(strtoupper($method));
        $user = auth()->user();

        if ($user && !$user->hasRole($role)) {
            return response(['message' => 'Permission Denied'], 403);
        }

        return $next($request);
    }
}
