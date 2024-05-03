<?php

namespace App\Http\Controllers;

use App\Models\Proprety;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // $unvalidatedProperties = Proprety::where('validated', false)->get();
        // $properties = Proprety::with('images')->paginate(6);
        $properties = Proprety::with('images')->get();

        return view('admin.index', compact('properties'));
    }

    public function validateProperty($id)
    {
        $property = Proprety::findOrFail($id);
        
        $property->validated = true;
        $property->save();
        
        return redirect()->route('admin.index')->with('success', 'Property validated successfully.');
    }
    public function unvalidateProperty($id)
    {
        // Find the property by ID
        $property = Proprety::findOrFail($id);
        
        // Unvalidate the property
        $property->validated = false;
        $property->save();
        
        return redirect()->route('admin.index')->with('success', 'Property unvalidated successfully.');
    }
    public function deleteProperty($id){
        $property = Proprety::FindOrFail($id);
        $property->delete();
        return redirect()->route('admin.index'); 
    }
}
