<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Optional: You can specify a redirect if the request is not expecting JSON
            return route('login');
        }

        // Return a JSON response for unauthenticated requests
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
