<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ListingType;
use App\Models\Proprety;
use App\Models\PropretyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropretyController extends Controller
{
    public function get()
    {
        $listings = Proprety::where('validated', true)->with(['listingType', 'category', 'images'])->get();
        $properties = Proprety::where('validated', true)->with('images')->take(12)->get();
        $categories = Category::all();
        // Loop through properties and keep only the first image
        $properties->each(function ($property) {
            $property->first_image = $property->images->isNotEmpty() ? $property->images->first()->image_path : null;
        });
    
        return view('proprety.proprety', compact('properties','listings','categories'));
    }

    public function create()
{
    $categories = Category::all();
    $listingTypes = ListingType::all();
    return view('proprety.createProprety', compact('categories', 'listingTypes'));
}

public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'description' => 'required|string',
            'property-category' => 'required|exists:categories,id',
            'listing-type' => 'required|exists:listing_types,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp' // Validate each image
        ]);
        $userId = Auth::id();

        // Create property
        $property = Proprety::create([
            'name' => $request->input('name'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'price' => $request->input('price'),
            'size' => $request->input('size'),
            'bedrooms' => $request->input('bedrooms'),
            'bathrooms' => $request->input('bathrooms'),
            'description' => $request->input('description'),
            'category_id' => $request->input('property-category'),
            'listing_type_id' => $request->input('listing-type'),
            'user_id' => $userId
        ]);
        
        // Handle property images
        // Handle property images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
                PropretyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imageName
                ]);
            }
        }

        return redirect()->route('index');
    }


    public function edit( string $id){
        $property = Proprety::FindOrFail($id);
        $categories = Category::all();
        $listingTypes = ListingType::all();


        return view('proprety.editProperty',compact('property', 'categories','listingTypes'));
    }

    public function update(Request $request , $id){
        $property = Proprety::FindOrFail($id);
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp', 
        ]);
        $property->update($request->all());
        return redirect()->route('profile'); 
        
    }
    public function show(string $id)
    {
        $property = Proprety::with('owner')->findOrFail($id);
        return view('proprety.showProprety', compact('property'));
    }


    public function destroy($id){
        $property = Proprety::FindOrFail($id);
        $property->delete();
        return redirect()->route('properties.index'); 
    }
}
