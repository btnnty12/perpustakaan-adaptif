<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // READ (LIST)
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
            'buku_id' => 'required|exists:buku,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // CEK STOK
        if ($buku->stok < 1) {
            return response()->json([
                'message' => 'Stok buku habis'
            ], 400);
        }

        // KURANGI STOK
        $buku->stok -= 1;
        $buku->save();

        // SIMPAN DATA PEMINJAMAN
        $pinjaman = Pinjaman::create([
            'pengguna_id' => $request->pengguna_id,
            'buku_id'     => $request->buku_id,
            'status'      => 'sedang_dibaca',
        ]);

        return response()->json([
            'message' => 'Buku berhasil dipinjam',
            'data'    => $pinjaman
        ], 201);
    }

    // UPDATE STATUS (misalnya selesai baca)
    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $request->validate([
            'status' => 'required|in:dibaca,sedang_dibaca,daftar_keinginan'
        ]);

        $pinjaman->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Status peminjaman diperbarui',
            'data' => $pinjaman
        ]);
    }

    // DELETE (PENGEMBALIAN BUKU)
    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        // TAMBAH STOK KEMBALI
        $buku = Buku::findOrFail($pinjaman->buku_id);
        $buku->stok += 1;
        $buku->save();

        // HAPUS DATA PEMINJAMAN
        $pinjaman->delete();

        return response()->json(['message' => 'Buku berhasil dikembalikan']);
    }
}
