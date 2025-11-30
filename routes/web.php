<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =======================
// HALAMAN UTAMA
// =======================
Route::get('/', function () {
    return view('welcome');
});

// =======================
// AUTH (Login - Register)
// =======================

// Tampilan Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login']);

// Tampilan Register
Route::get('/register', function () {
    return view('register'); 
})->name('register');

// Proses Register
Route::post('/register', function () {
    return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
});

// =======================
// HALAMAN USER
// =======================
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/notifikasi', function () {
    return view('notifikasi');   
})->name('notifikasi');

Route::get('/pesan', function () {
    return view('pesan');
})->name('pesan');

Route::get('/search', function () {
    return view('search');
})->name('search');

// =======================
// PENGEMBALIAN BUKU
// =======================
Route::get('/pengembalian-buku', function () {
    return view('index'); // sesuaikan jika file-nya index.blade.php
})->name('pengembalian.index');

Route::get('/create', function () {
    return view('create');
})->name('pengembalian.create');

// =======================
// ADMIN
// =======================
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

//logout
Route::get('/welcome', function () {
    return view('welcome');
});