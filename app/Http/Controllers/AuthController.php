<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required',
        ]);

        // Coba login
        // Kita mapping input 'kata_sandi' ke key 'password' agar dimengerti Auth::attempt
        $credentials = [
            'email' => $request->email,
            'password' => $request->kata_sandi 
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Cek Peran untuk Redirect
            $role = Auth::user()->peran;

            if ($role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('customer.dashboard'));
            }
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'telepon' => 'required|string|max:15',
            'kata_sandi' => 'required|min:6|confirmed',
        ]);

        // Simpan ke database
        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'kata_sandi' => Hash::make($request->kata_sandi), // Password wajib di-hash
            'peran' => 'customer', // Default role saat daftar
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}