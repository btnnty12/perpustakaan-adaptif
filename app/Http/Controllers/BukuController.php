<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // LIST BUKU
    public function index()
    {
        return response()->json(Buku::all());
    }

    // CREATE BUKU
    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string',
            'penulis'      => 'required|string',
            'genre'        => 'nullable|string',
            'deskripsi'    => 'nullable|string',
            'tahun_terbit' => 'required|integer',
            'stok'         => 'required|integer|min:0',
        ]);

        $buku = Buku::create($request->all());

        return response()->json([
            'message' => 'Buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }

    // DETAIL BUKU
    public function show($id)
    {
        return response()->json(Buku::findOrFail($id));
    }

    // UPDATE BUKU
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $buku->update($request->only([
            'judul', 'penulis', 'genre', 'deskripsi', 'tahun_terbit', 'stok'
        ]));

        return response()->json([
            'message' => 'Buku berhasil diperbarui',
            'data' => $buku
        ]);
    }

    // DELETE BUKU
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        // Opsional: blokir jika masih ada pinjaman aktif
        if ($buku->pinjaman()->where('status', 'sedang_dipinjam')->exists()) {
            return response()->json([
                'message' => 'Buku tidak bisa dihapus karena masih dipinjam'
            ], 400);
        }

        $buku->delete();

        return response()->json(['message' => 'Buku berhasil dihapus']);
    }
}
