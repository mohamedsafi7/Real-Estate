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
        $listings = Proprety::where('validated', true)->with(['listingType', 'category', 'images'])->get();
        $properties = Proprety::where('validated', true)->with('images')->take(9)->get();
        $categories = Category::all();
        $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();
        $topCities = Proprety::select('city')
            ->selectRaw('COUNT(*) as property_count')
            ->groupBy('city')
            ->orderByDesc('property_count')
            ->take(4)
            ->get();

        return view('welcome', compact('categories','properties','listings','topUsers','topCities'));
    }
}
