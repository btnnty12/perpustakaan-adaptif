<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        // Ambil daftar favorit dari session (array ID buku)
        $favorites = session('favorites', []);

        // Dummy buku (harus ada 'id' supaya toggle bisa berfungsi)
        $books = [
            ['id' => 1, 'judul' => 'Laskar Pelangi', 'cover' => 'dummy1.jpg'],
            ['id' => 2, 'judul' => 'Bumi Manusia', 'cover' => 'dummy2.jpg'],
            ['id' => 3, 'judul' => 'Negeri 5 Menara', 'cover' => 'dummy3.jpg'],
            ['id' => 4, 'judul' => 'UX Design Thinking', 'cover' => 'ux.jpg'],
        ];

        return view('favorit', compact('books', 'favorites'));
    }

    public function toggle($bookId)
    {
        $favorites = session()->get('favorites', []);

        if (in_array($bookId, $favorites)) {
            // Hapus dari favorit
            $favorites = array_diff($favorites, [$bookId]);
            session()->put('favorites', $favorites);

            return redirect()->back()->with('success', 'Buku dihapus dari favorit!');
        }

        // Tambahkan ke favorit
        $favorites[] = $bookId;
        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', 'Buku ditambahkan ke favorit!');
    }
}