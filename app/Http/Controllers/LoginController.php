<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $person = User::where('name', $username)->first();
        $person1 = Admin::where('name', $username)->first();

        if ($person && Hash::check($password, $person->password)) {
            auth()->guard('web')->login($person);
            return view('home')->with('<p>hello</p>');
        }elseif($person1 && Hash::check($password, $person1->password))
        {
            auth()->guard('admin')->login($person1);
            return view('home')->with('<p>hello</p>');
        }
        else {
            // throw ValidationException::withMessages(['name'=>'this value is not ok']);
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        auth()->guard('web')->logout();
        return redirect('/');
    }
}
