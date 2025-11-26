<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Buku;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // LIST PEMINJAMAN
    public function index()
    {
        $pinjaman = Pinjaman::with(['pengguna', 'buku'])->get();
        return response()->json($pinjaman);
    }

    // CREATE (PINJAM BUKU)
    public function store(Request $request)
    {
        $request->validate([
            'pengguna_id' => 'required|exists:pengguna,id',
            'buku_id'     => 'required|exists:buku,id',
        ]);

        $pengguna = Pengguna::findOrFail($request->pengguna_id);
        $buku     = Buku::findOrFail($request->buku_id);

        // Validasi role pengguna (hanya anggota atau staff)
        if (!in_array($pengguna->peran, ['anggota', 'staff'])) {
            return response()->json(['message' => 'Pengguna tidak berhak meminjam buku'], 403);
        }

        // Validasi stok buku
        if ($buku->stok < 1) {
            return response()->json(['message' => 'Stok buku tidak tersedia'], 400);
        }

        // Buat peminjaman
        $pinjaman = Pinjaman::create([
            'pengguna_id' => $pengguna->id,
            'buku_id'     => $buku->id,
            'status'      => 'sedang_dibaca',
        ]);

        // Kurangi stok buku
        $buku->decrement('stok');

        return response()->json([
            'message' => 'Buku berhasil dipinjam',
            'data' => $pinjaman
        ], 201);
    }

    // UPDATE STATUS
    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $request->validate([
            'status' => 'required|in:dibaca,sedang_dibaca,daftar_keinginan'
        ]);

        $pinjaman->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Status peminjaman diperbarui',
            'data' => $pinjaman
        ]);
    }

    // DELETE (PENGEMBALIAN)
    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $buku = $pinjaman->buku;

        // Tambah stok buku saat dikembalikan
        $buku->increment('stok');

        $pinjaman->delete();

        return response()->json(['message' => 'Buku berhasil dikembalikan']);
    }
}
