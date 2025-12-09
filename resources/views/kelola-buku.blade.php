<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f6d47f] flex">

<style>
#indicator {
    position: absolute;
    left: 0;
    top: 310px;
    width: 75px;
    height: 38px;
    background-color: #F7DE68;
    border-radius: 0 20px 20px 0;
    box-shadow: 0 6px 10px rgba(0,0,0,0.35);
    transition: 0.3s ease-in-out;
    z-index: 0;
}

.menu-item {
    position: relative;
    z-index: 5;
}

.menu-item img {
    width: 26px;
    height: 26px;
}

/* --- WRAPPER SETELAH JUDUL --- */
.section-wrapper {
    width: 100%;
    padding-left: 25px;   /* AGAR POSISINYA MENDUPLIKASI DATA ANGGOTA */
    padding-right: 40px;
    margin-top: 20px;
}

/* --- CARDS STATISTIK --- */
.stats-row {
    display: flex;
    justify-content: flex-start;   /* RATA KIRI */
    gap: 25px;
    margin-top: 25px;
    margin-left: 0; /* LURUS DENGAN JUDUL */
}

.stat-card {
    width: 240px;
    height: 120px;
    background: #A24731;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* --- TOMBOL TAMBAH BUKU & IMPORT EXCEL --- */
.top-buttons {
    position: absolute;
    right: 40px;
    top: 221px;    /* lebih naik sedikit dari sebelumnya */
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-green {
    background: #24A645;
    padding: 12px 24px;
    color: white;
    font-weight: 600;
    border-radius: 10px;
}

.btn-white {
    background: white;
    padding: 12px 24px;
    color: #333;
    font-weight: 600;
    border-radius: 10px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.15);
}

/* --- FILTER BAR (SEARCH + KATEGORI + STATUS) --- */
.filter-row {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 35px;
}

.filter-search {
    width: 320px;
}

.filter-select {
    width: 180px;
    height: 45px;
    border-radius: 8px;
}

.btn-search {
    background: #2476FF;
    padding: 10px 28px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    height: 45px;
}

/* --- TABEL --- */
.table-container {
    margin-top: 25px;
    width: 100%;
    padding: 0 40px;
}

</style>

<!-- ============================ SIDEBAR ============================ -->
<div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6">

    <div id="indicator"></div>

    <div class="flex flex-col items-center space-y-20 pt-20">

        <div class="menu-item"><img src="{{ asset('images/icon-home.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-anggota.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-buku.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-grafik.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-user.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-setting.png') }}" class="w-7"></div>

    </div>

    <img src="{{ asset('images/icon-logout.png') }}" class="w-7 mt-auto mb-4">
</div>

<!-- ============================ CONTENT ============================ -->
 <div class="flex-1 py-6 px-10">

<!-- TOPBAR -->
<div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">

    <!-- Divider kiri -->
    <div class="border-l border-white h-6"></div>

    <!-- Icon pesan -->
    <img src="{{ asset('images/icon-email.png') }}" class="w-6">

    <!-- Icon notif -->
    <img src="{{ asset('images/icon-notification.png') }}" class="w-6">

    <!-- Divider kanan -->
    <div class="border-l border-white h-6"></div>

    <!-- Profile -->
    <div class="flex items-center space-x-2">
        <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
            FA
        </div>
        <span class="text-black font-medium">Fayza Azzahra</span>
        <img src="{{ asset('images/icon-down-arrow.png') }}" class="w-4 ml-1">
    </div>

</div>

<!-- GARIS PEMBATAS PANJANG -->
<div class="w-full border-b-2 border-white mb-6"></div>

 <div class="section-wrapper">

    <h1 class="text-4xl font-bold">Kelola Buku !</h1>
    <p class="text-gray-700 mt-1">Kelola dan perbarui data koleksi buku perpustakaan.</p>

<!-- TOMBOL TAMBAH BUKU & IMPORT EXCEL -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="top-buttons">
    <a href="#form-tambah" class="btn-green">
        <i class="fa-solid fa-plus"></i> Tambah Buku
    </a>

    <a href="#form-import" class="btn-white">
        <i class="fa-solid fa-file-import"></i> Import Excel (CSV)
    </a>
</div>

    <!-- 4 KOTAK STATISTIK -->
    <div class="stats-row">
        <div class="stat-card">
            <h2 class="text-4xl font-bold">{{ $totalBuku ?? 0 }}</h2>
            <p>Total Buku</p>
        </div>

        <div class="stat-card">
            <h2 class="text-4xl font-bold">{{ $bukuTersedia ?? 0 }}</h2>
            <p>Buku Tersedia</p>
        </div>

        <div class="stat-card">
            <h2 class="text-4xl font-bold">{{ $sedangDipinjam ?? 0 }}</h2>
            <p>Sedang Dipinjam</p>
        </div>

        <div class="stat-card">
            <h2 class="text-4xl font-bold">{{ $bukuBaruBulanIni ?? 0 }}</h2>
            <p>Buku Baru Bulan Ini</p>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-row">

        <form method="GET" action="{{ route('kelola.buku') }}" class="flex gap-3 items-center">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search" class="filter-search shadow p-3 rounded-lg">
            <select class="filter-select shadow">
                <option>Kategori</option>
            </select>
            <select class="filter-select shadow">
                <option>Status</option>
            </select>
            <button type="submit" class="btn-search">Search</button>
        </form>

    </div>

</div>

<!-- ============================ FORM TAMBAH & IMPORT ============================ -->
<div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8" id="form-tambah">
    <form method="POST" action="{{ route('kelola.buku.store') }}" class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf
        <h3 class="text-xl font-bold">Tambah Buku</h3>
        <input name="judul" value="{{ old('judul') }}" placeholder="Judul" class="w-full border rounded p-3" required>
        <input name="penulis" value="{{ old('penulis') }}" placeholder="Penulis" class="w-full border rounded p-3" required>
        <input name="genre" value="{{ old('genre') }}" placeholder="Genre" class="w-full border rounded p-3">
        <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border rounded p-3">{{ old('deskripsi') }}</textarea>
        <div class="grid grid-cols-2 gap-4">
            <input name="tahun_terbit" type="number" value="{{ old('tahun_terbit') }}" placeholder="Tahun Terbit" class="w-full border rounded p-3" required>
            <input name="stok" type="number" min="0" value="{{ old('stok') }}" placeholder="Stok" class="w-full border rounded p-3" required>
        </div>
        <button type="submit" class="btn-green w-full text-center">Simpan Buku</button>
    </form>

    <form id="form-import" method="POST" action="{{ route('kelola.buku.import') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf
        <h3 class="text-xl font-bold">Import Buku (CSV)</h3>
        <p class="text-sm text-gray-600">Header wajib: judul, penulis, genre, deskripsi, tahun_terbit, stok</p>
        <input type="file" name="file" accept=".csv,text/csv" class="w-full border rounded p-3" required>
        <button type="submit" class="btn-white w-full text-center">Upload & Import</button>
    </form>
</div>

@if ($errors->any())
    <div class="mt-4 bg-red-100 text-red-700 rounded-lg p-4">
        <ul class="list-disc ml-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="mt-4 bg-green-100 text-green-700 rounded-lg p-4">
        {{ session('success') }}
    </div>
@endif

<!-- ============================ TABLE ============================ -->
<div class="mt-8 bg-white rounded-lg shadow overflow-hidden w-[97%]">

    <table class="w-full text-left">
        <thead class="bg-[#b54a38] text-white">
            <tr>
                <th class="px-6 py-4">ID Buku</th>
                <th class="px-6 py-4">Rak Buku</th>
                <th class="px-6 py-4">Judul Buku</th>
                <th class="px-6 py-4">Kategori</th>
                <th class="px-6 py-4">Stok</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-10 py-5">Opsi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($books as $book)
                <tr class="border-b">
                    <td class="px-6 py-3">{{ $book->id }}</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3">{{ $book->judul }}</td>
                    <td class="px-6 py-3">{{ $book->genre ?? '-' }}</td>
                    <td class="px-6 py-3">{{ $book->stok }}</td>
                    <td class="px-6 py-3 {{ $book->stok > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $book->stok > 0 ? 'Tersedia' : 'Tidak Tersedia' }}
                    </td>
                    <td class="px-6 py-3 flex gap-3">
                        <img src="{{ asset('icons/info.png') }}" class="w-5" title="Detail">
                        <img src="{{ asset('icons/edit.png') }}" class="w-5" title="Edit">
                        <img src="{{ asset('icons/delete.png') }}" class="w-5" title="Hapus">
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    <!-- ============================ PAGINATION ============================ -->
    <div class="flex flex-col items-center justify-center space-y-3 mt-6">
        <div class="flex items-center space-x-2">
            {{ $books->links('pagination::simple-tailwind') }}
        </div>
        <div class="flex items-center space-x-2">
            @for ($page = 1; $page <= $books->lastPage(); $page++)
                <div class="w-3 h-3 rounded-full {{ $books->currentPage() === $page ? 'bg-[#A63A2D]' : 'bg-gray-300' }}"></div>
            @endfor
        </div>
    </div>
    
</div>

<script>
document.querySelectorAll('.menu-item').forEach((item, index) => {
    item.addEventListener('click', function () {

        document.getElementById('indicator').style.top = (310 + index * 95) + 'px';

        // ROUTING UNTUK ADMIN
        if (index === 0) window.location.href = "/admin";           // dashboard
        if (index === 1) window.location.href = "/data-anggota";     // kelola buku
        if (index === 2) window.location.href = "/kelola-buku";    // data anggota
        if (index === 3) window.location.href = "/laporan-peminjaman"; // laporan
        if (index === 4) window.location.href = "/kelola-user";     // kelola user
        if (index === 5) window.location.href = "/pengaturan";      // setting
    });
});
</script>

</body>
</html>