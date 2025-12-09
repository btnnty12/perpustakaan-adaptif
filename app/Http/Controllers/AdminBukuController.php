<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminBukuController extends Controller
{
    // Tampilkan halaman kelola buku dengan data
    public function index()
    {
        $buku = Buku::all();
        return view('kelola-buku', compact('buku'));
    }

    // Tambah buku (sesuai struktur tabel `buku`)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'tahun_terbit' => 'nullable|integer|min:1500|max:2099',
            'stok' => 'required|integer|min:0',
        ]);

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'genre' => $request->genre,
            'deskripsi' => $request->deskripsi,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }

    // Import Excel ke tabel buku
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new \App\Imports\BukuImport, $request->file('file_excel'));

        return redirect()->back()->with('success', 'Import Excel berhasil');
    }
}
