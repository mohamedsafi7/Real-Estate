<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get(Request $request)
{
    $categories = Category::all();
    $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();
    $topCities = Proprety::select('city')
        ->selectRaw('COUNT(*) as property_count')
        ->groupBy('city')
        ->orderByDesc('property_count')
        ->take(4)
        ->get();

    // Fetch all properties by default
    $properties = Proprety::where('validated', true)
        ->with(['listingType', 'category', 'images']);

    // Check if the 'listingtype' parameter exists in the request
    if ($request->has('listingtype')) {
        $listingType = $request->input('listingtype');
        // Filter properties based on the listing type
        $properties->whereHas('listingType', function ($query) use ($listingType) {
            $query->where('name', $listingType);
        });
    }

    $properties = $properties->get();

    // Fetch all listings (optional)
    $listings = Proprety::where('validated', true)
        ->with(['listingType', 'category', 'images'])
        ->get();

    return view('welcome', compact('categories', 'properties', 'listings', 'topUsers', 'topCities'));
}

}
