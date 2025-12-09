<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
     // Menampilkan semua pengguna
    public function index()
    {
        $pengguna = Pengguna::all();
        return response()->json($pengguna);
    }

    // Menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna);
    }

    // Menambah pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
            'peran' => 'nullable|in:admin,pengguna,staff'
        ]);

        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->password),
            'peran' => $request->peran ?? 'pengguna'
        ]);

        return response()->json([
            'message' => 'Pengguna berhasil ditambahkan',
            'data' => $pengguna
        ]);
    }

    // Update data pengguna
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $pengguna->update([
            'nama' => $request->nama ?? $pengguna->nama,
            'email' => $request->email ?? $pengguna->email,
            'peran' => $request->peran ?? $pengguna->peran,
        ]);

        return response()->json([
            'message' => 'Data pengguna berhasil diperbarui',
            'data' => $pengguna
        ]);
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        Pengguna::findOrFail($id)->delete();
        return response()->json(['message' => 'Pengguna berhasil dihapus']);
    }
}
