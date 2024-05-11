<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!auth()->check() || !auth()->user()->isAdmin()) {
        //     abort(403, 'Unauthorized');
        // }

        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect()->route('index')->with('error', 'Unauthorized access');
        }
        
        return $next($request);
    }
}
