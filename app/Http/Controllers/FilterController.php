<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use App\Models\User;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all categories
        $categories = Category::all();
        $properties = Proprety::all();
        $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();

        if ($request->has('category')) {
            $filteredProperties = Proprety::where('category_id', $request->category)->get();
        } else {
            $filteredProperties = Proprety::all();
        }
        
        return view('category.Hotel', compact('properties','filteredProperties','topUsers'));
    }

    public function show(Request $request)
{
    // Fetch all properties with their images
    $properties = Proprety::with('images');

    // Fetch all categories
    $categories = Category::all();
    $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();

    // Filter by category if a filter option is selected
    if ($request->filled('category_filter')) {
        $categoryName = $request->input('category_filter');
        // Use whereHas to filter properties by category name
        $properties->whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        });
    }

    // Filter by location if a filter option is selected
    if ($request->filled('location')) {
        $locationName = $request->input('location');
        // Use where to filter properties by location (city)
        $properties->where('city', $locationName);
    }

    // Filter by listing type if a filter option is selected
    if ($request->filled('listing_type')) {
        $listingType = $request->input('listing_type');
        $properties->where('listing_type_id', $listingType);
    }

    // Get the filtered properties
    $listings = $properties->get();
    $topCities = Proprety::select('city')
        ->selectRaw('COUNT(*) as property_count')
        ->groupBy('city')
        ->orderByDesc('property_count')
        ->take(4)
        ->get();

    return view('welcome', compact('listings', 'properties', 'categories', 'topUsers', 'topCities'));
}
public function filterProperties(Request $request)
{
    $category = $request->get('category');
    $location = $request->get('location');

    $propertiesQuery = Proprety::query();

    if ($category) {
        $propertiesQuery->where('category', $category);
    }

    if ($location) {
        $propertiesQuery->where('city', $location); // Use the correct column name here
    }

    $properties = $propertiesQuery->get();

    return view('filtered_properties', compact('properties'));
}



}
