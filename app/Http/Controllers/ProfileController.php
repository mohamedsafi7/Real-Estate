<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proprety;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function get (){
        $user = auth()->user();
        $pubs = $user->properties;
        return view('profile', compact('user','pubs'));
    }
    
    public function edit (string $id){
        $user = User::findOrFail($id);
        return view('editprofile', compact('user'));
    }
    

    public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp', 
    ]);
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/users', $name);
        $user->image = $name;
    }

    $user->save();

    return redirect()->route('profile');
}

   
    
}
