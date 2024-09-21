<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'student' role
        if (Auth::check() && Auth::user()->role == 'student') {
            return $next($request);
        }

        // If not a student, redirect to login or show an unauthorized message
        return redirect('/login')->with('error', 'You do not have student access.');
    }
}