<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function get (){
        $user = auth()->user(); 
        return view('profile', compact('user'));
    }
    
    public function edit (string $id){
        $user = User::findOrFail($id);
        return view('editprofile', compact('user'));
    }
    
    public function update (Request $request,string $id){
        $request ->validate([
            'email' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg',

        ]);

        $user=User::FindOrFail($id);

        $user ->name =$request->input('name');
        $user ->email =$request->input('email');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/uploads',$name);
            $user->image = $name;
        }
        $user->save();
        return redirect()->route('profile');

    }
}
