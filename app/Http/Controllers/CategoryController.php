<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            dd('No categories found in database!');
        } else {
            // dd($categories);
            return view('Admin.add-category', compact('categories'));
        }
        // $categories = Category::all();
        // dd($categories);
        // return view('Admin.add-product', compact('categories'));
        // return view('Admin.add-product')->with('categories', $categories);
        // return View::make('admin.add-product', ['categories' => $categories]); // ارسال به ویو
        // view()->share('categories', $categories); // ارسال به تمام ویوها
        // return view('admin.add-product', ['categories' => $categories]); // ارسال به ویو
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }
}
