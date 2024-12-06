<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('admin')->check()) {
            return $next($request);
        } elseif (auth()->guard('user')->check()) {
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
}
