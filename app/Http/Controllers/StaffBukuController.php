<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StaffBukuController extends Controller
{
    /**
     * Export data buku ke Excel (CSV format yang bisa dibuka di Excel)
     */
    public function export()
    {
        $buku = Buku::select('judul', 'penulis', 'genre', 'tahun_terbit', 'stok', 'deskripsi')
            ->orderBy('judul')
            ->get();

        $filename = 'data_buku_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Tambahkan BOM untuk UTF-8 agar Excel membaca dengan benar
        $callback = function() use ($buku) {
            $file = fopen('php://output', 'w');
            
            // Tambahkan BOM untuk UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header kolom
            fputcsv($file, [
                'Judul',
                'Penulis',
                'Kategori',
                'Tahun Terbit',
                'Stok',
                'Deskripsi'
            ], ';'); // Gunakan semicolon untuk kompatibilitas Excel Indonesia
            
            // Data buku
            foreach ($buku as $row) {
                fputcsv($file, [
                    $row->judul ?? '',
                    $row->penulis ?? '',
                    $row->genre ?? '',
                    $row->tahun_terbit ?? '',
                    $row->stok ?? 0,
                    $row->deskripsi ?? ''
                ], ';');
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

