<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    // Halaman pengaturan
    public function index()
    {
        $user = Auth::user();

        // Cek apakah admin atau user
        $idLabel = $user->role === 'admin' ? 'ID Admin' : 'ID User';
        $idValue = $user->id;

        return view('pengaturan', [
            'nama' => $user->name,
            'email' => $user->email,
            'telepon' => $user->telepon ?? '',
            'tanggalBergabung' => $user->created_at->format('d F Y'),
            'idLabel' => $idLabel,
            'idValue' => $idValue
        ]);
    }

    // Update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profile', 'public');
            $user->foto = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon = $request->telepon ?? $user->telepon;

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}