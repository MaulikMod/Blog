<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     * Checks if a user session exists (MongoDB custom session-based auth).
     * If not, redirects to /login with an informative message.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Please login to access this page.');
        }

        return $next($request);
    }
}
