<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            Log::error('User not authenticated');
            abort(403, 'Unauthorized.');
        }

        // Log role user yang sedang login
        Log::info('User ID: ' . auth()->id() . ' | Role: ' . auth()->user()->role . ' | Required Role: ' . $role);

        // Cek apakah role user sesuai dengan yang diizinkan
        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
