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
