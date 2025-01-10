<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'gender' => 'required|in:Male,Female',
            'hobbies' => 'required|array|min:3',
            'instagram_username' => 'required|regex:/^[a-zA-Z0-9._]+$/',
            'mobile_number' => 'required|digits_between:10,15',
            'password' => 'required|min:6|confirmed',
            'payment_amount' => 'required|numeric|between:100000,125000'
        ]);
    
        $validated['password'] = Hash::make($validated['password']);
        $validated['instagram_username'] = 'http://www.instagram.com/' . $validated['instagram_username'];
    
        $user = User::create($validated);
        Auth::login($user);
    
        return redirect()->route('payment.show');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
