<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware عمومی (Global Middleware)
     * این میان‌افزارها برای هر درخواست وب اعمال می‌شوند.
     */
    protected $middleware = [
        // چک کردن Maintenance Mode
        // \App\Http\Middleware\CheckForMaintenanceMode::class,

        // کنترل اندازه درخواست
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // فیلتر کردن ورودی‌ها برای جلوگیری از حملات XSS
        // \App\Http\Middleware\TrimStrings::class,

        // تبدیل فیلدهای خالی به null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware گروهی
     * این گروه‌ها برای دسته‌بندی و اعمال میان‌افزارهای مشابه بر اساس نوع درخواست استفاده می‌شوند.
     */
    protected $middlewareGroups = [
        'web' => [
            // \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,

            // اشتراک‌گذاری خطاها در Views
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // حفاظت از CSRF
            // \App\Http\Middleware\VerifyCsrfToken::class,

            // روتینگ session-based
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api', // محدود کردن تعداد درخواست‌ها
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware مسیری (Route Middleware)
     * این میان‌افزارها فقط برای مسیری خاص اعمال می‌شوند.
     */
    protected $routeMiddleware = [
        // 'auth' => \App\Http\Middleware\Authenticate::class,
        // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role' => \App\Http\Middleware\CheckUserRole::class, // میدل‌ور چک نقش کاربران
    ];
}
