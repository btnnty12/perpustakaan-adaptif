<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/notifikasi', function () {
    return view('notifikasi');
});
Route::get('/search', function () {
    return view('search');
})->name('search');
Route::get('/pengembalian-buku', function () {
    return view('index');
});
Route::get('/create', function () {
    return view('create');
});