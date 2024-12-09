<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware;
use Illuminate\Support\Facades\Storage;

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

    // مدریت اسلایدر 
    public function showSliderManagement()
    {
        $sliders = Slider::all();
        $products = Product::all(); // لیست محصولات برای لینک‌دادن
        return view('Admin.slider-management', compact('sliders', 'products'));
    }
    
    public function uploadSlider(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id' => 'nullable|exists:products,id',
        ]);
    
        $path = $request->file('image')->store('sliders', 'public');
    
        if (Slider::count() >= 4) {
            $oldestSlider = Slider::oldest()->first();
            if ($oldestSlider) {Storage::disk('public')->delete($oldestSlider->image_path);
                $oldestSlider->delete();
            }
        }
    
        Slider::create([
            'image_path' => $path,
            'product_id' => $request->product_id,
        ]);
    
        return redirect()->route('admindashboard')->with('success', 'اسلاید جدید با موفقیت اضافه شد!');
    }
    

}
