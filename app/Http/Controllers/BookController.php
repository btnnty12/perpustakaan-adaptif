<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // READ (LIST)
    public function index()
    {
        $buku = Buku::all();
        return response()->json($buku);
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|integer|min:1',
        ]);

        $buku = Buku::create($request->all());

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

        $buku->update($request->all());

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
