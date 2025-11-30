<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Dummy login admin
        if ($request->username === "admin" && $request->password === "admin123") {
            return redirect('/admin');
        }

        // User biasa (apapun username-password ke home)
        return redirect('/home');
    }

    public function register(Request $request)
    {
        // Karena belum pakai database, kita anggap berhasil daftar
        return redirect('/login')->with('success', 'Berhasil mendaftar! Silakan login.');
    }
}