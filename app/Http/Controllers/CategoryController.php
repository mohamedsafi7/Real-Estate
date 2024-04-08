<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get()
    {
        $categories = Category::all();
        return view('category.category', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);
    
        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categories.index');
    }
}
