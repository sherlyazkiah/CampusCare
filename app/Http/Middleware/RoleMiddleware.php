<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403); // user belum login
        }

        $user = Auth::user();

        if (!in_array($user->role->name, $roles)) {
            abort(403); // role tidak sesuai
        }

        return $next($request);
    }
}
