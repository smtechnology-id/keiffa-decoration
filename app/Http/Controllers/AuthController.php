<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'no_hp' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
       ]);

       User::create([
        'name' => $request->name,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'level' => 'user',
        'password' => Hash::make($request->password),
       ]);

       return redirect()->route('login')->with('success', 'Register Success');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(Auth::attempt($request->only('email', 'password'))) {
            if(Auth::user()->level == 'admin') {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->level == 'user') {
                return redirect()->route('user.index');
            }
        }

        return back()->with('error', 'Login Failed');   
    }
}
