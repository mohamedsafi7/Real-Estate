<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get()
    {
        $listings = Proprety::with(['listingType', 'category', 'images'])->get();
        $properties = Proprety::with('images')->get();
        $categories = Category::all();
        return view('welcome', compact('categories','properties','listings'));
    }



    

}
