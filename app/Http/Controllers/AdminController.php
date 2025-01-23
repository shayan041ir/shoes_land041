<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Http\Middleware;

class AdminController extends Controller
{

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


    public function adminupdate(Request $request)
    {
        // اعتبارسنجی اطلاعات ورودی
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'nullable|email|unique:admins,email',
            'password' => 'nullable|string|min:4|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->back()->withErrors(['error' => 'ادمین یافت نشد.']);
        }

        $admin->name = $request->input('name');

        // در صورت وجود رمز عبور جدید، رمز عبور را به‌روز‌رسانی کنید
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

    // در صورت وجود ایمیل جدید، بررسی کنید که تکراری نباشد
    if ($request->filled('email')) {
        $existingAdmin = Admin::where('email', $request->input('email'))->first();
        if ($existingAdmin && $existingAdmin->id !== $admin->id) {
            return redirect()->back()->withErrors(['email' => 'این ایمیل از قبل وجود دارد.']);
        }
        $admin->email = $request->input('email');
    }
        
        // ذخیره تغییرات
        $admin->save();

        // بازگرداندن پیام موفقیت
        return redirect()->back()->with('success', 'اطلاعات با موفقیت به‌روز شد.');
    }


    public function delete($id)
    {
        $admin = Admin::findOrFail($id); // ادمین مورد نظر را پیدا کنید
        // حذف ادمین
        $admin->delete();

        return redirect()->route('admindashboard')->with('success', "ادمین {$admin->name} با موفقیت حذف شد.");
    }


    public function adduser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        auth()->guard('web')->login($user);
        $a = "user added";
        return redirect()->route('admindashboard')->with('a', 'user added successfully!');
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // حذف کاربر
        $user->delete();

        return redirect()->route('admindashboard')->with('success', "کاربر {$user->name} با موفقیت حذف شد.");
    }







    // تغییرات محصول
    public function editProduct($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all(); // لیست دسته‌بندی‌ها برای انتخاب
        return view('Admin.edit-product', compact('product', 'categories'));
    }


    public function updateProduct(Request $request)
    {
        // جستجوی محصول بر اساس نام
        $product = Product::where('name', $request->input('name'))->first();
        if (!$product) {
            return redirect()->back()->withErrors(['msg' => 'محصولی با این نام یافت نشد.']);
        }
    
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:100',
            'material' => 'nullable|string|max:100',
            'brand' => 'nullable|string|max:100',
        ]);
    
        // آپلود تصویر (در صورت وجود)
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }
    
        // به‌روزرسانی فیلدهایی که تغییر کرده‌اند
        $data = $request->only(['description', 'price', 'stock', 'color', 'material', 'brand']);
        foreach ($data as $key => $value) {
            if ($value !== null) {
                $product->$key = $value;
            }
        }
    
        $product->save();
    
        return redirect()->route('admindashboard')->with('success', 'محصول با موفقیت به‌روزرسانی شد!');
    }
    




    // مدریت اسلایدر 
    public function showSliderManagement()
    {
        $sliders = Slider::all();
        $products = Product::all(); // لیست محصولات برای لینک‌دادن
        return view('Admin.slider-management', compact('sliders', 'products'));
    }

    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);

        // حذف تصویر از فضای ذخیره‌سازی
        if ($slider->image_path) {
            Storage::disk('public')->delete($slider->image_path);
        }

        // حذف رکورد از دیتابیس
        $slider->delete();

        return redirect()->back()->with('success', 'اسلاید با موفقیت حذف شد!');
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
            if ($oldestSlider) {
                Storage::disk('public')->delete($oldestSlider->image_path);
                $oldestSlider->delete();
            }
        }

        Slider::create([
            'image_path' => $path,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('admindashboard')->with('success', 'اسلاید جدید با موفقیت اضافه شد!');
    }



    

    public function showOrders()
    {
        $orders = Order::with(['user', 'items.product'])->get();

        return view('Admin.admin-factor', compact('orders'));
    }
}
