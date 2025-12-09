<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika user belum login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil peran dari Auth user (fallback ke session jika perlu)
        $userRole = optional(Auth::user())->peran ?? session('role');

        // Jika role user tidak ada dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Redirect sesuai role user, default ke login agar tidak loop
            return match ($userRole) {
                'admin' => redirect()->route('admin')->with('error', 'Tidak punya akses'),
                'staff' => redirect()->route('staff')->with('error', 'Tidak punya akses'),
                'pengguna' => redirect()->route('home')->with('error', 'Tidak punya akses'),
                default => redirect('/login')->with('error', 'Tidak punya akses'),
            };
        }

        return $next($request);
    }
}