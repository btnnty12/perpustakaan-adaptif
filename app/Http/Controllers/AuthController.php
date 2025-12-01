<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * REGISTER
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email|unique:pengguna,email',
            'kata_sandi' => 'required|string|min-6',
            'peran'      => 'in:admin,anggota,staff'
        ]);

        $user = Pengguna::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'kata_sandi' => $request->kata_sandi, // otomatis di-hash dari mutator
            'peran'      => $request->peran ?? 'anggota',
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user'    => $user
        ], 201);
    }

    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'kata_sandi' => 'required|string'
        ]);

        $user = Pengguna::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return response()->json([
                'message' => 'Email atau kata sandi salah'
            ], 401);
        }

        // Hapus token lama
        $user->tokens()->delete();

        // Buat token baru
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => $user
        ]);
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        // Hapus token yang sedang dipakai
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}
