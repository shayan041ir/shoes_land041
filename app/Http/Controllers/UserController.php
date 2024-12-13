<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('User.userdashboard');
    }

    public function update(Request $request)
    {
        // اعتبارسنجی اطلاعات ورودی
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:4|confirmed',
        ]);

        // بازیابی کاربر جاری
        $user = Auth::user();

        // به‌روز‌رسانی نام کاربر
        $user->name = $request->input('name');

        // در صورت وجود رمز عبور جدید، رمز عبور را به‌روز‌رسانی کنید
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // ذخیره تغییرات
        $user->save();

        // بازگرداندن پیام موفقیت
        return redirect()->back()->with('success', 'اطلاعات با موفقیت به‌روز شد.');
    }
}
