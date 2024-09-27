<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            Log::info("User is not logged in. Redirecting to login page...");
            return redirect('/login');
        }
        
        Log::info("User is logged in.");

        if (Auth::user()->userRole && Auth::user()->isAdmin()) {
            Log::info("Admin access granted.");
            return $next($request);
        }

        Log::warning("User does not have admin access.");
        abort(403);
    }
}