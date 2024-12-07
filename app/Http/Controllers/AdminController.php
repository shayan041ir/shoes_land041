<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware;

class AdminController extends Controller
{
    // فقط ادمین‌ها می‌توانند به این متدها دسترسی داشته باشند
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');  // فرض می‌کنیم سیستم احراز هویت جداگانه برای ادمین‌ها دارید
    // }

    // نمایش صفحه داشبورد ادمین
    public function index()
    {
        return view('Admin.admindashboard');
    }


    public function addadmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        auth()->guard('admin')->login($admin);
        $s = "admin added";
        return redirect()->route('admindashboard')->with('s', 'Admin added successfully!');
    }



    // تغییرات محصول
    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('admin.editProduct', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return redirect()->route('admin.dashboard');
    }

    // مدیریت اطلاعات سایت
    public function updateSiteInfo(Request $request)
    {
        // کد تغییرات اطلاعات سایت
        return redirect()->route('admin.dashboard');
    }
}
