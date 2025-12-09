<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = Pengguna::where('email', $request->email)->first();

        // Debug: Log untuk melihat apakah user ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan!'
            ])->withInput($request->only('email'));
        }

        // Verifikasi password
        if (Hash::check($request->kata_sandi, $user->kata_sandi)) {
            
            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            
            // Set session data
            $request->session()->put([
                'email' => $user->email,
                'nama'  => $user->nama,
                'role'  => $user->peran,
            ]);

            // Redirect sesuai peran
            switch ($user->peran) {
                case 'admin':
                    return redirect()->route('admin')->with('success', 'Selamat datang Admin!');
                case 'staff':
                    return redirect()->route('staff')->with('success', 'Selamat datang Staff!');
                case 'pengguna':
                    return redirect()->route('home')->with('success', 'Selamat datang!');
                default:
                    return redirect()->route('home')->with('success', 'Selamat datang!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah!'
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
        ]);

        // Buat pengguna baru
        // Perhatikan: mutator setKataSandiAttribute akan otomatis hash password
        $pengguna = Pengguna::create([
            'nama' => $request->name,
            'email' => $request->email,
            'kata_sandi' => $request->password, // Mutator akan hash otomatis
            'peran' => 'pengguna', // Default peran
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        // Hapus semua session data
        $request->session()->forget(['email', 'nama', 'role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}