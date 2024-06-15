<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationalSupervisorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'educational_supervisor') {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Access Denied');
    }
}