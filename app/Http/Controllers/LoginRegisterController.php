<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class LoginRegisterController extends Controller
{
    // Homepage
    public function home()
    {
        return view('home');
    }

    // Registration
public function store(Request $req)
{
    // Validate data
    $req->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|confirmed', 
    ]);

    $hashedPassword = Hash::make($req->password);

    $user = DB::table('users')->insert([
        'name' => $req->name,
        'email' => $req->email,
        'password' => $hashedPassword
    ]);
    $req->session()->flash('success', 'Successfully registered, Now please Log-In to get Task details');

    $redirectUrl = route('home'); 

    return response()->json(['success' => true, 'redirect' => $redirectUrl]);
}



    //login
    public function authenticate(Request $request)
     {
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
         if (Auth::attempt($credentials)) {
             $request->session()->regenerate();
             return redirect()->route('dashboard')->with('success', 'You have successfully logged in!');
         }
 
         return back()
         ->withInput($request->only('email')) 
         ->withErrors([
             'email' => 'Your provided credentials do not match our records.',
         ]);
 }

 //logout
 public function logout(Request $request)
 {
     Auth::logout();
     $request->session()->invalidate();
     $request->session()->regenerateToken();
     return redirect()->route('home')->with('success', 'You have logged out successfully!');
 }
}
