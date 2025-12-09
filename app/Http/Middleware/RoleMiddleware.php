<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika user belum login (session kosong)
        if (!session()->has('peran')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userRole = session('peran'); // Ambil peran user dari session

        // Jika role user tidak ada dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Redirect sesuai role user
            return match ($userRole) {
                'admin' => redirect()->route('admin')->with('error', 'Tidak punya akses'),
                'staff' => redirect()->route('staff')->with('error', 'Tidak punya akses'),
                default => redirect()->route('home')->with('error', 'Tidak punya akses'),
            };
        }

        return $next($request);
    }
}