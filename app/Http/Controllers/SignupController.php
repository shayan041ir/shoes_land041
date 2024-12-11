<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class SignupController extends Controller
{
    public function index()
    {
        return view('template.singup');
    }
 
    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // رمزنگاری رمز عبور
        ]);
        auth()->guard('web')->login($user);
        return view('template.login')->with('success', 'User created successfully!');
    }
}
