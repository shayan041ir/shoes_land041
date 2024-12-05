<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        // بررسی اگر کاربر وارد شده باشد و رول او 'admin' باشد
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // اجازه ادامه درخواست را می‌دهیم
        }

        // در غیر این صورت، کاربر را به صفحه ورود هدایت می‌کنیم
        return redirect('/login')->with('error', 'Access denied.');
    }
}

