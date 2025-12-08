<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;

Route::get('/', fn() => view('welcome'));

Route::middleware(['auth'])->group(function () {
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware(['auth'])->group(function () {

    // halaman favorit
    Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit');

    // hapus favorit
    Route::delete('/favorit/{bookId}', [FavoriteController::class, 'destroy'])->name('favorite.remove');

});


Route::get('/admin', fn() => view('admin'))->name('admin');
Route::get('/data-anggota', fn() => view('data-anggota'))->name('data.anggota');
Route::get('/kelola-buku', fn() => view('kelola-buku'))->name('kelola.buku');
Route::get('/laporan-peminjaman', fn() => view('laporan-peminjaman'))->name('laporan-peminjaman');
Route::get('/kelola-user', fn() => view('kelola-user'))->name('kelola-user');
Route::get('/pengaturan', fn() => view('pengaturan'))->name('pengaturan');

Route::get('/pinjaman', function () {
    return view('peminjaman'); // pastikan file resources/views/peminjaman.blade.php ada
});
Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit');

// Toggle favorit (tambah/hapus)
Route::post('/favorite/toggle/{bookId}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');


Route::get('/detail/{buku}', function ($buku) {

$books = [
    "Machine Learning" => [
        "id"     => 1,
        "title"  => "Machine Learning",
        "author" => "Andrew Ng",
        "year"   => 2018,
        "img"    => "/images/machine Learning.jpegg",
        "desc"   => "Pengenalan komprehensif tentang machine learning dan algoritma modern.",
        "genre"  => "Teknologi",
        "stok"   => 12,
        "bahasa" => "Indonesia",
    ],

    "Artificial Intelligence" => [
        "id"     => 2,
        "title"  => "Artificial Intelligence",
        "author" => "Stuart Russell",
        "year"   => 2020,
        "img"    => "/images/download (1).jpe",
        "desc"   => "Dasar dan perkembangan AI dari klasik hingga deep learning.",
        "genre"  => "Teknologi",
        "stok"   => 9,
        "bahasa" => "Indonesia",
    ],

    "Cyber Security" => [
        "id"     => 3,
        "title"  => "Cyber Security",
        "author" => "Kevin Mitnick",
        "year"   => 2019,
        "img"    => "/images/download (2).jpeg",
        "desc"   => "Panduan keamanan digital bagi pengguna modern.",
        "genre"  => "Keamanan",
        "stok"   => 6,
        "bahasa" => "Indonesia",
    ],

    "Kalkulus Book" => [
        "id"     => 4,
        "title"  => "Kalkulus Book",
        "author" => "James Stewart",
        "year"   => 2015,
        "img"    => "images/download (2).jpeg",
        "desc"   => "Dasar-dasar kalkulus untuk mahasiswa dan profesional.",
        "genre"  => "Matematika",
        "stok"   => 11,
        "bahasa" => "Indonesia",
    ],

    "UX Design Thinking" => [
        "id"     => 5,
        "title"  => "UX Design Thinking",
        "author" => "Don Norman",
        "year"   => 2019,
        "img"    => "https://i.ibb.co/XFZwcNm/ux.jpg",
        "desc"   => "Pendekatan human centered design dalam pembuatan produk digital.",
        "genre"  => "Desain",
        "stok"   => 4,
        "bahasa" => "Indonesia",
    ],

    "Pemrograman Aplikasi Web" => [
        "id"     => 6,
        "title"  => "Pemrograman Aplikasi Web",
        "author" => "Budi Santoso",
        "year"   => 2020,
        "img"    => "https://i.ibb.co/rGdm32f/web.jpg",
        "desc"   => "Buku dasar dan lanjutan tentang pengembangan aplikasi web modern.",
        "genre"  => "Teknologi",
        "stok"   => 7,
        "bahasa" => "Indonesia",
    ],

    "Java Book" => [
        "id"     => 7,
        "title"  => "Java Book",
        "author" => "Herbert Schildt",
        "year"   => 2019,
        "img"    => "https://i.ibb.co/xDLMp7R/java.jpg",
        "desc"   => "Panduan lengkap bahasa pemrograman Java dari dasar hingga OOP.",
        "genre"  => "Pemrograman",
        "stok"   => 5,
        "bahasa" => "Indonesia",
    ],

    "Python Book" => [
        "id"     => 8,
        "title"  => "Python Book",
        "author" => "Mark Lutz",
        "year"   => 2021,
        "img"    => "https://i.ibb.co/S6Wbn5p/python.jpg",
        "desc"   => "Pembelajaran Python modern mulai dari sintaks hingga proyek nyata.",
        "genre"  => "Pemrograman",
        "stok"   => 8,
        "bahasa" => "Indonesia",
    ],

    "Docker Book" => [
        "id"     => 9,
        "title"  => "Docker Book",
        "author" => "Adrian Mouat",
        "year"   => 2018,
        "img"    => "https://i.ibb.co/PYY8spf/docker.jpg",
        "desc"   => "Panduan lengkap containerization menggunakan Docker untuk developer.",
        "genre"  => "Teknologi",
        "stok"   => 6,
        "bahasa" => "Indonesia",
    ],

    "Statistika Buku" => [
        "id"     => 10,
        "title"  => "Statistika Buku",
        "author" => "Sudjana",
        "year"   => 2017,
        "img"    => "https://i.ibb.co/Kxqs6bQ/statistika.jpg",
        "desc"   => "Pembahasan konsep dasar statistika, distribusi, dan analisis data.",
        "genre"  => "Matematika",
        "stok"   => 10,
        "bahasa" => "Indonesia",
    ],

    "Laskar Pelangi" => [
        "id"     => 11,
        "title"  => "Laskar Pelangi",
        "author" => "Andrea Hirata",
        "year"   => 2005,
        "img"    => "laskar_pelangi.jpg",
        "desc"   => "Cerita inspiratif tentang anak-anak di Belitung yang mengejar pendidikan.",
        "genre"  => "Fiksi",
        "stok"   => 10,
        "bahasa" => "Indonesia",
    ],

    "Bumi Manusia" => [
        "id"     => 12,
        "title"  => "Bumi Manusia",
        "author" => "Pramoedya Ananta Toer",
        "year"   => 1980,
        "img"    => "bumi_manusia.jpg",
        "desc"   => "Novel tentang kolonialisme Belanda dan kehidupan pribumi di Jawa.",
        "genre"  => "Sejarah",
        "stok"   => 8,
        "bahasa" => "Indonesia",
    ],

    "Negeri 5 Menara" => [
        "id"     => 13,
        "title"  => "Negeri 5 Menara",
        "author" => "Ahmad Fuadi",
        "year"   => 2009,
        "img"    => "negeri_5_menara.jpg",
        "desc"   => "Perjalanan anak muda menempuh pendidikan di pesantren dan menara ilmu.",
        "genre"  => "Fiksi",
        "stok"   => 7,
        "bahasa" => "Indonesia",
    ],

];

    if (!isset($books[$buku])) {
        abort(404);
    }

    return view('detail', ['book' => $books[$buku]]);
})->name('detail');

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', fn() => view('register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', fn() => view('home'))->middleware('role:pengguna')->name('home');

    Route::get('/notifikasi', fn() => view('notifikasi'))->middleware('role:pengguna')->name('notifikasi');

    Route::get('/pesan', fn() => view('pesan'))->middleware('role:pengguna')->name('pesan');

    Route::get('/search', fn() => view('search'))->middleware('role:pengguna')->name('search');

    Route::get('/staff', fn() => view('staff'))->middleware('role:staff')->name('staff');

    Route::get('/pengembalian-buku', fn() => view('index'))->middleware('role:pengguna')->name('pengembalian.index');

    Route::get('/create', fn() => view('create'))->middleware('role:pengguna')->name('pengembalian.create');

});