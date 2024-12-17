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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:4|confirmed',
            'address' => 'nullable|string|max:255',
        ]);

        // بازیابی کاربر جاری
        $user = Auth::user();

        // به‌روز‌رسانی نام کاربر
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->address = $validatedData['address'] ?? $user->address;
        // در صورت وجود رمز عبور جدید، رمز عبور را به‌روز‌رسانی کنید
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // ذخیره تغییرات
        $user->save();

        // بازگرداندن پیام موفقیت
        return redirect()->back()->with('success', 'اطلاعات با موفقیت به‌روز شد.');
    }
}
