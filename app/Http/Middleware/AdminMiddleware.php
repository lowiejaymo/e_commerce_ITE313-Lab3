<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure the user is authenticated and has the Admin role (role_id = 1)
        if (Auth::check() && Auth::user()->userRole && Auth::user()->userRole->role_id == 1) {
            return $next($request);
        }

        // If not, return 403 Forbidden
        abort(403);
    }
}
