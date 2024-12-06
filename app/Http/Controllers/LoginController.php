<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // $credentials = $request->only('name', 'password');

        // // تلاش برای ورود به عنوان ادمین
        // if (Auth::guard('admin')->attempt($credentials)) {
        //     return redirect()->route('admindashboard');
        // }

        // // تلاش برای ورود به عنوان کاربر عادی
        // if (Auth::guard('web')->attempt($credentials)) {
        //     return redirect()->route('user.dashboard');
        // }

        // // اگر ورود ناموفق بود
        // return redirect()->back()->withErrors(['error' => 'اطلاعات ورود اشتباه است.']);

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $person = User::where('name', $username)->first();
        $person1 = Admin::where('name', $username)->first();

        if ($person && Hash::check($password, $person->password)) {
            return view('user.userdashboard')->with('<p>hello</p>');
        } elseif ($person1 && Hash::check($password, $person1->password)) {
            return view('Admin.admindashboard')->with('<p>hello</p>');
        } else {
            return view('login')->with('error', 'Try again');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
