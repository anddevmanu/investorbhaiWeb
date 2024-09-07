<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check()) {
            $userRoles = explode('|', $role);

            Log::info('User role:', ['role' => Auth::user()->role]);
            Log::info('Allowed roles:', ['roles' => $userRoles]);

            if (in_array(Auth::user()->role, $userRoles)) {
                return $next($request);
            }
        }

        Log::info('Showing the user profile for user:', ['id' => Auth::user()]);

        return redirect()->route('home')->with('error', 'Access denied');
    }
}
