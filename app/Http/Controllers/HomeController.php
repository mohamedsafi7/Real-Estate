<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get()
    {
        $categories = Category::all();
        $properties = Proprety::with('images')->get();
        return view('welcome', compact('categories','properties'));
    }
}
