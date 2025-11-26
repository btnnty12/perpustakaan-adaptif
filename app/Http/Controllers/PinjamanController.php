<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Buku;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // LIST PINJAMAN
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

        // Validasi role
        if (!in_array($pengguna->peran, ['anggota', 'staff'])) {
            return response()->json(['message' => 'Pengguna tidak berhak meminjam buku'], 403);
        }

        // Validasi stok
        if ($buku->stok < 1) {
            return response()->json(['message' => 'Stok buku tidak tersedia'], 400);
        }

        // Buat peminjaman awal dengan status "sedang_dipinjam"
        $pinjaman = Pinjaman::create([
            'pengguna_id' => $pengguna->id,
            'buku_id'     => $buku->id,
            'status'      => 'sedang_dipinjam',
        ]);

        // Kurangi stok
        $buku->decrement('stok');

        return response()->json([
            'message' => 'Buku berhasil dipinjam',
            'data' => $pinjaman
        ], 201);
    }

    // UPDATE STATUS PEMINJAMAN
    public function update(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        $request->validate([
            'status' => 'required|in:wishlist,sedang_dipinjam,dikembalikan'
        ]);

        $old = $pinjaman->status;
        $new = $request->status;

        // Jika berubah menjadi dikembalikan, tambahkan stok (hanya 1x)
        if ($old !== 'dikembalikan' && $new === 'dikembalikan') {
            $pinjaman->buku->increment('stok');
        }

        $pinjaman->update(['status' => $new]);

        return response()->json([
            'message' => 'Status peminjaman berhasil diperbarui',
            'data' => $pinjaman
        ]);
    }

    // PENGEMBALIAN BUKU
    public function returnBook($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        // Cegah double return
        if ($pinjaman->status === 'dikembalikan') {
            return response()->json(['message' => 'Buku sudah dikembalikan sebelumnya'], 400);
        }

        // Update status & kembalikan stok
        $pinjaman->update(['status' => 'dikembalikan']);
        $pinjaman->buku->increment('stok');

        return response()->json(['message' => 'Buku berhasil dikembalikan']);
    }
}
