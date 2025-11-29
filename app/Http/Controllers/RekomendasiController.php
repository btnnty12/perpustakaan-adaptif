<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    // Menampilkan semua rekomendasi
    public function index()
    {
        $rek = Rekomendasi::with(['pengguna', 'buku'])->get();
        return response()->json($rek);
    }

    // Menambah rekomendasi baru
    public function store(Request $request)
    {
        $request->validate([
            'pengguna_id' => 'required|exists:pengguna,id',
            'buku_id' => 'required|exists:buku,id',
            'skor_rekomendasi' => 'nullable|numeric'
        ]);

        $rek = Rekomendasi::create([
            'pengguna_id' => $request->pengguna_id,
            'buku_id' => $request->buku_id,
            'skor_rekomendasi' => $request->skor_rekomendasi ?? null,
        ]);

        return response()->json([
            'message' => 'Rekomendasi berhasil dibuat',
            'data' => $rek
        ]);
    }

    // Detail rekomendasi
    public function show($id)
    {
        $rek = Rekomendasi::with(['pengguna', 'buku'])->findOrFail($id);
        return response()->json($rek);
    }

    // Update rekomendasi
    public function update(Request $request, $id)
    {
        $rek = Rekomendasi::findOrFail($id);
        $rek->update($request->only('skor_rekomendasi'));

        return response()->json(['message' => 'Rekomendasi diperbarui']);
    }

    // Hapus rekomendasi
    public function destroy($id)
    {
        ReKomendasi::findOrFail($id)->delete();
        return response()->json(['message' => 'Rekomendasi dihapus']);
    }
}
