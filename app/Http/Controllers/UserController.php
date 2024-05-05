<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('register');
    }

    /**
     * Create a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerUser(Request $request)
    {
        try {
            // Validate user input
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if ($validateUser->fails()) {
                return redirect('/register')->withErrors($validateUser)->withInput();
            }

            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return redirect('/login')->with('success', 'Registration successful. Please login.');
        } catch (\Throwable $th) {
            return redirect('/register')->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Login a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginUser(Request $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return redirect('/login')->with('error', 'Invalid credentials')->withInput();
            }
            
            session(['authenticated' => true]);
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', $th->getMessage())->withInput();
        }
    }
/**
 * Logout the authenticated user.
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function logoutUser(Request $request)
{
    try {
        $request->user()->tokens()->delete();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    } catch (\Throwable $th) {
        return redirect()->route('login');
    }
}



}
