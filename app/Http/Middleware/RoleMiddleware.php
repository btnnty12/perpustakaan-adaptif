<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userRole = session('role');

        // Cek apakah role user sesuai
        // 'anggota' di database sama dengan 'pengguna' di routes
        $userPeran = Auth::user()->peran;
        $allowedRoles = [$role];
        
        // Jika route meminta 'pengguna', terima juga 'anggota'
        if ($role === 'pengguna') {
            $allowedRoles = ['pengguna', 'anggota'];
        }
        
        if (!in_array($userPeran, $allowedRoles)) {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}