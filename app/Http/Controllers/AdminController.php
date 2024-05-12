<?php

namespace App\Http\Controllers;

use App\Models\Proprety;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query builder
        $properties = Proprety::query();
    
        // Check if the 'validated' parameter exists in the request
        if ($request->has('validated')) {
            // Convert the parameter value to boolean
            $validated = $request->validated == '1';
    
            // Filter properties based on the validation status
            $properties->where('validated', $validated);
        }
    
        // Fetch properties with images, ordered by creation date, and paginate the results
        $properties = $properties->with('images')->orderBy('created_at', 'desc')->paginate(12);
    
        // Pass the filtered properties to the view
        return view('admin.index', compact('properties'));
    }
    
    
    
    
    public function users(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function validateProperty($id)
    {
        $property = Proprety::findOrFail($id);
        
        $property->validated = true;
        $property->save();
        
        return redirect()->route('admin.index')->with('success', 'Property validated successfully.');
    }
    public function validateUser($id)
    {
        $user = User::findOrFail($id);
        
        $user->role = 'admin';

        $user->save();
        
        return redirect()->route('admin.userslist')->with('success', 'users validated successfully.');
    }
    public function unvalidateUser($id)
    {
        $user = User::findOrFail($id);
        
        $user->role = 'user';
        $user->save();
        
        return redirect()->route('admin.userslist')->with('success', 'user unvalidated successfully.');
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
    public function deleteUser($id){
        $user = User::FindOrFail($id);
        $user->delete();
        return redirect()->route('admin.userslist'); 
    }
}
