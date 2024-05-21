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
    public function get(Request $request)
    {
        // Fetch all listings
        $listings = Proprety::where('validated', true)->with(['listingType', 'category', 'images'])->get();
        
        // Fetch all categories
        $categories = Category::all();
        
        // Fetch all properties
        $properties = Proprety::query();

        $listingTypes = ListingType::all();

    
        // Check if the 'validated' parameter exists in the request
        if ($request->has('validated')) {
            // Convert the parameter value to boolean
            $validated = $request->validated == '1';
    
            // Filter properties based on the validation status
            $properties->where('validated', $validated);
        }
    
        // Check if the 'listingType' parameter exists in the request
        if ($request->has('listingType')) {
            // Filter properties based on the listing type
            $properties->whereHas('listingType', function ($query) use ($request) {
                $query->where('name', $request->listingType);
            });
        }
    
        // Check if the 'category_filter' parameter exists in the request
        if ($request->has('category_filter')) {
            // Filter properties based on the category
            $properties->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category_filter);
            });
        }
        
        // Check if the 'location_filter' parameter exists in the request
        if ($request->has('location_filter')) {
            $locationFilter = strtolower($request->input('location_filter')); // Convert input to lowercase
            $properties->whereRaw('LOWER(city) LIKE ?', ["%$locationFilter%"]); // Compare case-insensitively
        }
    
        // Fetch properties with images, tags, ordered by creation date, and paginate the results
        $properties = $properties->orderBy('created_at', 'desc')->paginate(12);
    
        // Get unique cities from listings
        $uniqueCities = $listings->pluck('city')->unique();
    
        return view('proprety.proprety', compact('properties', 'listings', 'categories', 'uniqueCities','listingTypes'));
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp',

        ]);

        $userId = Auth::id();

        // Create property
        $property = new Proprety();
        $property->name = $request->input('name');
        $property->city = $request->input('city');
        $property->address = $request->input('address');
        $property->price = $request->input('price');
        $property->size = $request->input('size');
        $property->bedrooms = $request->input('bedrooms');
        $property->bathrooms = $request->input('bathrooms');
        $property->description = $request->input('description');
        $property->category_id = $request->input('property-category');
        $property->listing_type_id = $request->input('listing-type');
        $property->user_id = auth()->id(); 

        if ($request->has('tags')) {
            $property->tags = json_encode($request->input('tags'));
        }
    
        $property->save();
        // if ($request->has('tags')) {
        //     $property->tags = implode(',', $request->input('tags'));
        // }
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

        return redirect()->route('property.show', $property->id);
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
    public function filterProperties(Request $request)
    {
        $query = Proprety::query();
    
        // Apply location filter if present
        if ($request->filled('location_filter')) {
            $query->where('city', $request->input('location_filter'));
        }
    
        // Apply category filter if present
        if ($request->filled('category_filter') && $request->input('category_filter') != 'Property Category') {
            $category = Category::where('name', $request->input('category_filter'))->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
    
        // Apply tags filter if present
        if ($request->filled('tags')) {
            $tags = $request->input('tags');
            $query->where(function ($q) use ($tags) {
                foreach ($tags as $tag) {
                    $q->orWhere('tags', 'like', '%"'.$tag.'"%');
                }
            });
        }
        if ($request->has('listing_type_id') && !empty($request->listing_type_id)) {
            $query->where('listing_type_id', $request->listing_type_id);
        }
        $listingTypes = ListingType::all();

        // Fetch the filtered properties
        $properties = $query->get();
    
        // Fetch unique categories and cities for the filters
        $categories = Category::all();
        $uniqueCities = Proprety::select('city')->distinct()->get();
    
        // Fetch all unique tags
            $tagsArray = Proprety::select('tags')->distinct()->get()->pluck('tags')->flatten()->toArray();
            $tags = [];

            foreach ($tagsArray as $tagString) {
                if ($tagString !== null) {
                    $decodedTags = json_decode($tagString, true);
                    if ($decodedTags !== null) {
                        $tags = array_merge($tags, $decodedTags);
                    }
                }
            }

    
        // Redirect back to the properties view with filtered data
        return view('proprety.proprety', compact('properties', 'categories', 'uniqueCities', 'tags','listingTypes'));
    }
    


    public function destroy($id){
        $property = Proprety::FindOrFail($id);
        $property->delete();
    return redirect()->back();
    }
}
