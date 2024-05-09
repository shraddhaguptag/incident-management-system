<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm(){
        return view('register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'user_type' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'pin_code' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->user_type = $request->input('user_type');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->pin_code = $request->input('pin_code');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Redirect or do any other operations after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. You can now login.');
    }
}
