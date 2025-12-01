<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
            'peran' => 'nullable|in:admin,anggota,staff'
        ]);

        $pengguna = Pengguna::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'kata_sandi' => $validated['password'],
            'peran' => $validated['peran'] ?? 'anggota'
        ]);

        return response()->json([
            'message' => 'Pengguna berhasil ditambahkan',
            'data' => $pengguna
        ], 201);
    }

    // Update data pengguna
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('pengguna', 'email')->ignore($pengguna->id),
            ],
            'password' => 'nullable|min:6',
            'peran' => 'nullable|in:admin,anggota,staff'
        ]);

        $data = [
            'nama' => $validated['nama'] ?? $pengguna->nama,
            'email' => $validated['email'] ?? $pengguna->email,
            'peran' => $validated['peran'] ?? $pengguna->peran,
        ];

        if (array_key_exists('password', $validated)) {
            $data['kata_sandi'] = $validated['password'];
        }

        $pengguna->update($data);

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
