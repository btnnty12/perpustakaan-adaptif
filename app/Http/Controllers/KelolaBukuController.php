<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KelolaBukuController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $query = Buku::query();
        if ($q) {
            $query->where(function ($qq) use ($q) {
                $qq->where('judul', 'LIKE', "%{$q}%")
                   ->orWhere('penulis', 'LIKE', "%{$q}%")
                   ->orWhere('genre', 'LIKE', "%{$q}%")
                   ->orWhere('deskripsi', 'LIKE', "%{$q}%");
            });
        }

        $books = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        $totalBuku        = Buku::count();
        $bukuTersedia     = Buku::where('stok', '>', 0)->count();
        $sedangDipinjam   = Pinjaman::where('status', '!=', 'dikembalikan')->count();
        $bukuBaruBulanIni = Buku::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->count();

        return view('kelola-buku', [
            'books'             => $books,
            'totalBuku'         => $totalBuku,
            'bukuTersedia'      => $bukuTersedia,
            'sedangDipinjam'    => $sedangDipinjam,
            'bukuBaruBulanIni'  => $bukuBaruBulanIni,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'genre'        => 'nullable|string|max:100',
            'deskripsi'    => 'nullable|string',
            'tahun_terbit' => 'required|integer|min:1500|max:2099',
            'stok'         => 'required|integer|min:0',
        ]);

        Buku::create($validated);

        return back()->with('success', 'Buku berhasil ditambahkan.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file    = $request->file('file');
        $handle  = fopen($file->getRealPath(), 'r');
        $header  = fgetcsv($handle, 0, ',');

        $expected = ['judul', 'penulis', 'genre', 'deskripsi', 'tahun_terbit', 'stok'];
        if (!$header || array_map('strtolower', $header) !== $expected) {
            return back()->withErrors(['file' => 'Header harus: judul, penulis, genre, deskripsi, tahun_terbit, stok']);
        }

        $created = 0;
        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            if (count($row) < 6) {
                continue;
            }

            [$judul, $penulis, $genre, $deskripsi, $tahun, $stok] = $row;

            Buku::create([
                'judul'        => $judul,
                'penulis'      => $penulis,
                'genre'        => $genre ?? null,
                'deskripsi'    => $deskripsi ?? null,
                'tahun_terbit' => (int) $tahun,
                'stok'         => (int) $stok,
            ]);
            $created++;
        }

        fclose($handle);

        return back()->with('success', "Import selesai. {$created} buku ditambahkan.");
    }
}
