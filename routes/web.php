<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffBukuController;
use App\Models\Buku;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Umum
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('welcome');
Route::view('/welcome', 'welcome');

/*
|--------------------------------------------------------------------------
| DETAIL BUKU (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/detail/{slug}', function (string $slug) {
    $books = Buku::dummyData();

    if (!isset($books[$slug])) {
        abort(404);
    }

    return view('detail', ['book' => $books[$slug]]);
})->name('detail');

/*
|--------------------------------------------------------------------------
| AUTH (Login - Register - Logout)
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', fn () => view('register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| HALAMAN SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        $user = [
            'nama' => session('nama', 'Pengguna'),
            'email' => session('email'),
            'role' => session('role'),
        ];
        return view('home', ['user' => $user]);
    })
        ->middleware('role:pengguna,staff,admin')
        ->name('home');

    Route::view('/notifikasi', 'notifikasi')
        ->middleware('role:pengguna,staff,admin')
        ->name('notifikasi');

    Route::view('/search', 'search')
        ->middleware('role:pengguna,staff,admin')
        ->name('search');

    Route::view('/pengembalian-buku', 'index')
        ->middleware('role:pengguna')
        ->name('pengembalian.index');

    Route::view('/pengembalian/create', 'create')
        ->middleware('role:pengguna')
        ->name('pengembalian.create');

    Route::get('/create', fn () => redirect()->route('pengembalian.create'))
        ->middleware('role:pengguna');

    Route::view('/pinjaman', 'peminjaman')
        ->middleware('role:pengguna')
        ->name('pinjaman.index');

    Route::get('/favorit', [FavoriteController::class, 'index'])
        ->middleware('role:pengguna')
        ->name('favorite.index');

    Route::post('/favorit/{slug}', [FavoriteController::class, 'toggle'])
        ->middleware('role:pengguna')
        ->name('favorite.toggle');

    Route::view('/pengaturan', 'pengaturan')
        ->middleware('role:pengguna,staff,admin')
        ->name('pengaturan');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::redirect('/settings', '/pengaturan');

    // Dashboard staff
    Route::view('/staff', 'staff')
        ->middleware('role:staff')
        ->name('staff');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
});

// Halaman operasional ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/data-anggota', 'data-anggota')->name('data.anggota');
    Route::view('/kelola-buku', 'kelola-buku')->name('kelola.buku');
    Route::view('/laporan-peminjaman', 'laporan-peminjaman')->name('laporan-peminjaman');
    Route::view('/kelola-user', 'kelola-user')->name('kelola-user');
});

// Halaman operasional STAFF (path terpisah tapi UI sama)
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::view('/', 'staff')->name('dashboard');
    Route::view('/data-anggota', 'staff.data-anggota')->name('data-anggota');
    Route::view('/kelola-buku', 'staff.kelola-buku')->name('kelola-buku');
    Route::view('/kelola-buku/create', 'staff.kelola-buku-create')->name('kelola-buku.create');
    Route::view('/kelola-buku/import', 'staff.kelola-buku-import')->name('kelola-buku.import');
    Route::get('/kelola-buku/export', [StaffBukuController::class, 'export'])->name('kelola-buku.export');
    Route::view('/laporan-peminjaman', 'staff.laporan-peminjaman')->name('laporan-peminjaman');
    Route::view('/pengaturan', 'staff.pengaturan')->name('pengaturan');
    
    // Route untuk log performa pencarian (tanpa controller baru)
    Route::post('/log-search', function (\Illuminate\Http\Request $request) {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return response()->json(['success' => false], 401);
        }
        
        try {
            \App\Models\LogPencarian::create([
                'pengguna_id' => \Illuminate\Support\Facades\Auth::id(),
                'kata_kunci' => $request->input('kata_kunci', ''),
                'jumlah_hasil' => $request->input('jumlah_hasil', 0),
                'algorithm' => $request->input('algorithm', 'bf'),
                'process_time_ms' => $request->input('process_time_ms', 0),
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    })->name('log-search');
});

// Route untuk pencarian string matching (bisa digunakan oleh semua role yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::post('/api/string-match', function (\Illuminate\Http\Request $request) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'text' => 'required|string',
            'pattern' => 'required|string',
            'algorithm' => 'string|in:bf,kmp,bm',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $text = $request->input('text');
            $pattern = $request->input('pattern');
            $algorithm = $request->input('algorithm', 'bm');

            $startTime = microtime(true);
            $positions = \App\Services\StringMatching::matchPositions($text, $pattern, $algorithm, true);
            $processTime = (microtime(true) - $startTime) * 1000; // dalam ms

            return response()->json([
                'success' => true,
                'data' => [
                    'positions' => $positions,
                    'hasMatch' => count($positions) > 0,
                    'algorithm' => $algorithm,
                    'process_time_ms' => $processTime,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat melakukan pencarian',
            ], 500);
        }
    })->name('api.string-match');
});