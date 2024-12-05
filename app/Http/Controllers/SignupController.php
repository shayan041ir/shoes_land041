<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class SignupController extends Controller
{
    public function index()
    {
        return view('singup');
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // رمزنگاری رمز عبور
        ]);
        return redirect('/login')->with('success', 'User created successfully!');
    }
}
