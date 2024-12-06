<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        dd($categories);
        return view('Admin.add-category', compact('categories'));
        // return view('Admin.add-product')->with('categories', $categories);
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
