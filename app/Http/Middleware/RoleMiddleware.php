<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
    
        if ($user->role === 'admin') {
            // Admin can see everything by faculty
            return $next($request);
        } elseif ($user->role === 'level_one') {
            // Level one user: Education manager
            // Can see everything by faculty and make changes except user section
            return $next($request);
        } elseif ($user->role === 'level_two') {
            // Level two user: Faculty manager
            // Can see and manage their own faculty's data
            // Dashboard, courses, professors, classes, class locations, reports, attendance
            // Can only select term, not create or manage terms
            return $next($request);
        } elseif ($user->role === 'level_three') {
            // Level three user: Can only view courses and professors
            // Can fully use reports and attendance for their own faculty
            return $next($request);
        } else {
            // If the user role is not recognized, deny access
            return response('Unauthorized', 403);
        }
    }
}