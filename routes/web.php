<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Halaman Umum
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| AUTH (Login - Register)
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Register
Route::get('/register', fn() => view('register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| HALAMAN SETELAH LOGIN
|--------------------------------------------------------------------------
|
| Dibedakan berdasarkan role:
| admin  -> /admin
| staff  -> /staff
| pengguna -> /home
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Pengguna
    Route::get('/home', fn() => view('home'))->middleware('role:pengguna')->name('home');
    Route::get('/notifikasi', fn() => view('notifikasi'))->middleware('role:pengguna')->name('notifikasi');
    Route::get('/pesan', fn() => view('pesan'))->middleware('role:pengguna')->name('pesan');
    Route::get('/search', fn() => view('search'))->middleware('role:pengguna')->name('search');

    // Admin - nonaktifkan sementara
    // Route::get('/admin', fn() => view('admin'))->middleware('role:admin')->name('admin');

    // Staff (jika ada halaman staff)
    Route::get('/staff', fn() => view('staff'))->middleware('role:staff')->name('staff');

    /*
    |--------------------------------------------------------------------------
    | PENGEMBALIAN BUKU (khusus Pengguna misalnya)
    |--------------------------------------------------------------------------
    */
    Route::get('/pengembalian-buku', fn() => view('index'))
        ->middleware('role:pengguna')
        ->name('pengembalian.index');

    Route::get('/create', fn() => view('create'))
        ->middleware('role:pengguna')
        ->name('pengembalian.create');

       
});

//user biar bisa buka halaman tanpa login//

// Admin (tanpa login dulu)
Route::get('/admin', fn() => view('admin'))->name('admin');

// Data Anggota (tanpa login dulu)
Route::get('/data-anggota', fn() => view('data-anggota'))->name('data.anggota');

// Kelola Buku (tanpa login dulu)
Route::get('/kelola-buku', fn() => view('kelola-buku'))->name('kelola.buku');

// Laporan Peminjaman (tanpa login dulu)
Route::get('/laporan-peminjaman', fn() => view('laporan-peminjaman'))->name('laporan-peminjaman');

// Kelola User (tanpa login dulu)
Route::get('/kelola-user', fn() => view('kelola-user'))->name('kelola-user');

// Kelola User (tanpa login dulu)
Route::get('/pengaturan', fn() => view('pengaturan'))->name('pengaturan');