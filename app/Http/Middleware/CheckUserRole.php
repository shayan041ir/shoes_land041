<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($role === 'admin' && Auth::guard('admin')->check()) {
            return $next($request);
        }

        if ($role === 'user' && Auth::guard('web')->check()) {
            return $next($request);
        }

        return redirect('/home');
    }
}
