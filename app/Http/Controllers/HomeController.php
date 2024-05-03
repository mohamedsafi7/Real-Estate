<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get()
    {
        $listings = Proprety::with(['listingType', 'category', 'images'])->get();
        $properties = Proprety::with('images')->get();
        $categories = Category::all();
        $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();
        return view('welcome', compact('categories','properties','listings','topUsers'));
    }



    

}
