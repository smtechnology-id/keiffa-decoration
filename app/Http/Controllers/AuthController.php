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
            'no_hp' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'jenis_kelamin' => 'required',
        ]);
        //    Seeting bahasa validasi
        $messages = [
            'name.required' => 'Nama harus diisi',
            'no_hp.required' => 'No. Telepon harus diisi',
            'no_hp.unique' => 'No. Telepon sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ];


        User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'level' => 'user',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silahkan login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->level == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->level == 'user') {
                return redirect()->route('user.index');
            }
        } else {
            return back()->with('error', 'Kombinasi email dan password tidak sesuai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
