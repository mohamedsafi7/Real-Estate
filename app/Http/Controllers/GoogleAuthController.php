<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

        } catch (\Exception $e) {
           
            return redirect()->route('login')->with('error', 'Google authentication failed');
        }
    
        
        $existingUser = User::where('email', $user->email)->first();
    
        if ($existingUser) {
            Auth::login($existingUser);

            return redirect()->route('index');

        } else {
            
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
               
            ]);
    
            
            Auth::login($newUser);
        }
    
        
        return redirect()->route('index');
        
    }
}
