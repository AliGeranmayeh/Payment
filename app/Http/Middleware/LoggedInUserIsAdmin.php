<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggedInUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authedUser = auth()->user();

        if ($authedUser && $authedUser->isAdmin()) {
            return $next($request);
        }
        return response()->json(['error' => 'Permission denied'], 403);

    }
}
