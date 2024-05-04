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
    $propreties = Proprety::all();
    $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();


    if ($request->has('category')) {
        $filteredProperties = Proprety::where('category_id', $request->category)->get();
    } else {
        $filteredProperties = Proprety::all();
    }
    
    return view('category.Hotel', compact('propreties','filteredProperties','topUsers'));
}
public function show(Request $request)
{
    // Récupérer toutes les propriétés avec leurs images
    $properties = Proprety::with('images');
    $query = Proprety::query();

    // Récupérer toutes les catégories
    $categories = Category::all();
    $topUsers = User::withCount('properties')->orderByDesc('properties_count')->take(4)->get();

    // Filtrer par catégorie si une option de filtre est sélectionnée
    if ($request->filled('catigory_filter')) {
        $categoryName = $request->input('catigory_filter');
        $properties->whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        });
    }
    if ($request->filled('location_filter')) {
        $locationName = $request->input('location_filter');

            $query->where('name', $locationName);
       
    }
    switch ($request->input('listing_type')) {
        case 'rent':
            $properties->where('listing_type_id', '1');
            break;
        case 'sell':
            $properties->where('listing_type_id', '2');
            break;
        default:
            // No filter applied
            break;
    }
    $listings = $properties->get();

    return view('welcome', compact('listings', 'properties', 'categories','topUsers'));
}


}
