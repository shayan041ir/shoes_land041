<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'nullable|string|max:50',
            'material' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // حداکثر 2 مگابایت
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id', // هر دسته‌بندی باید معتبر باشد
        ]);

        // آپلود تصویر
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // ایجاد محصول
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'color' => $request->color,
            'material' => $request->material,
            'brand' => $request->brand,
            'image' => $imagePath,
        ]);

        // اتصال دسته‌بندی‌ها
        if ($request->categories) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function insertP(Request $request)
    {
        $categories = Category::all();
        $brand = $request->input('brand');
        $selectedCategory = $request->input('category', 'all');
    
        // فیلتر محصولات بر اساس برند و دسته‌بندی
        $products = Product::query();
    
        if ($brand) {
            $products->where('brand', 'like', "%$brand%");
        }
    
        if ($selectedCategory !== 'all') {
            $category = Category::where('name', $selectedCategory)->first();
            if ($category) {
                $products->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                });
            }
        }
    
        $products = $products->get();
    
        // پاسخ به درخواست
        if ($request->ajax()) {
            return response()->json([
                'products' => $products,
            ]);
        }
    
        return view('home', compact('categories', 'products', 'selectedCategory'));
    }
    
    
}
