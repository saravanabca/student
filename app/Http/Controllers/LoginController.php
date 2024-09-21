<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;



class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function signupform()
    {
        return view('signup');
    }

    public function login_auth(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if (Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password])) {
                    return response()->json([
                        'loginsuccess'=>true,
                        'message' => 'Welcome',

                    ]);   
                } else {
                    return response()->json([
                        'loginsuccess'=>false,
                        'message' => 'Authentication failed. Password does not match. Please ensure that the entered passwords match each other.'
                    ]);    
                }
            } 
            else {
                return response()->json([
                    'loginsuccess'=>false,
                    'message' => 'Invalid username or password. Please try again'
                ]);    
            }
        } 
        else {
            return response()->json([
                'loginsuccess'=>false,
                'message' => 'Invalid username or password. Please try again',
            ]);    
    
        }
    }
    
    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        try {
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);
    
            Auth::login($user);
            event(new Registered($user));
    
            return response()->json([
                'signup' => true,
                'success' => true,
                'message' => 'User Created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'signup' => false,
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
}