<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

// CRUD Buku
Route::apiResource('buku', BookController::class);

// CRUD Pinjaman
Route::apiResource('pinjaman', BorrowingController::class);
