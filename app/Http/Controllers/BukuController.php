<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // READ (LIST BUKU)
    public function index()
    {
        $buku = Buku::all();
        return response()->json($buku);
    }

    // CREATE
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

        $buku = Buku::create($request->only([
            'judul', 'penulis', 'genre', 'deskripsi', 'tahun_terbit', 'stok'
        ]));

        return response()->json([
            'message' => 'Buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }

    // SHOW DETAIL
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return response()->json($buku);
    }

    // UPDATE
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

    // DELETE
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return response()->json(['message' => 'Buku berhasil dihapus']);
    }
}
