<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
{
    // Fetch all categories
    $categories = Category::all();
    $propreties = Proprety::all();

    if ($request->has('category')) {
        $filteredProperties = Proprety::where('category_id', $request->category)->get();
    } else {
        $filteredProperties = Proprety::all();
    }
    
    return view('category.Hotel', compact('propreties','filteredProperties'));
}
public function show(Request $request)
{
    // Récupérer toutes les propriétés avec leurs images
    $properties = Proprety::with('images');

    // Récupérer toutes les catégories
    $categories = Category::all();

    // Filtrer par catégorie si une option de filtre est sélectionnée
    if ($request->filled('catigory_filter')) {
        $categoryName = $request->input('catigory_filter');
        $properties->whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        });
    }

    // Récupérer les propriétés filtrées
    $listings = $properties->get();

    return view('welcome', compact('listings', 'properties', 'categories'));
}


}
