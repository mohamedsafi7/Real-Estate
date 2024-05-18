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
            ->with(['listingType', 'category', 'images'])
            ->orderBy('created_at', 'desc');

        // Filter properties based on listing type if provided
        if ($request->has('listingtype')) {
            $listingType = $request->input('listingtype');
            $properties->whereHas('listingType', function ($query) use ($listingType) {
                $query->where('name', $listingType);
            });
        }

        // Filter properties based on category if provided
        if ($request->has('category_filter')) {
            $category = $request->input('category_filter');
            $properties->where('category_id', $category);
        }

        // Filter properties based on location if provided
        if ($request->has('location')) {
            $location = $request->input('location');
            $properties->where('city', $location);
        }

        $properties = $properties->get();

        // Fetch all listings (optional)
        $listings = Proprety::where('validated', true)
            ->with(['listingType', 'category', 'images'])
            ->get();

        return view('welcome', compact('categories', 'properties', 'listings', 'topUsers', 'topCities'));
    }
}
