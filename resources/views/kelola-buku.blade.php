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
    <button class="btn-green">
        <i class="fa-solid fa-plus"></i> Tambah Buku
    </button>

    <button class="btn-white">
        <i class="fa-solid fa-file-import"></i> Import Excel
    </button>
</div>

    <!-- 4 KOTAK STATISTIK -->
    <div class="stats-row">
        <div class="stat-card">
            <h2 class="text-4xl font-bold">255</h2>
            <p>Total Buku</p>
        </div>

        <div class="stat-card">
            <h2 class="text-4xl font-bold">224</h2>
            <p>Buku Tersedia</p>
        </div>

        <div class="stat-card">
            <h2 class="text-4xl font-bold">150</h2>
            <p>Sedang Dipinjam</p>
        </div>

        <div class="stat-card">
            <h2 class="text-4xl font-bold">10</h2>
            <p>Buku Baru Bulan Ini</p>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-row">

        <input type="text" placeholder="Search"
               class="filter-search shadow p-3 rounded-lg">

        <select class="filter-select shadow">
            <option>Kategori</option>
        </select>

        <select class="filter-select shadow">
            <option>Status</option>
        </select>

        <button class="btn-search">Search</button>
    </div>

</div>

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

            <!-- 1 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-001</td>
                <td class="px-6 py-3">Rak-001</td>
                <td class="px-6 py-3">Bahasa Inggris untuk Akademik</td>
                <td class="px-6 py-3">Bahasa</td>
                <td class="px-6 py-3">8</td>
                <td class="px-6 py-3 text-green-600 font-semibold">Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 2 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-002</td>
                <td class="px-6 py-3">Rak-002</td>
                <td class="px-6 py-3">Algoritma dan Struktur Data</td>
                <td class="px-6 py-3">Pemrograman</td>
                <td class="px-6 py-3">3</td>
                <td class="px-6 py-3 text-red-600 font-semibold">Tidak Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 3 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-003</td>
                <td class="px-6 py-3">Rak-003</td>
                <td class="px-6 py-3">Psikologi Remaja Modern</td>
                <td class="px-6 py-3">Psikologi</td>
                <td class="px-6 py-3">6</td>
                <td class="px-6 py-3 text-green-600 font-semibold">Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 4 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-004</td>
                <td class="px-6 py-3">Rak-004</td>
                <td class="px-6 py-3">Dasar-Dasar Akuntansi</td>
                <td class="px-6 py-3">Akuntansi</td>
                <td class="px-6 py-3">10</td>
                <td class="px-6 py-3 text-green-600 font-semibold">Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 5 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-005</td>
                <td class="px-6 py-3">Rak-005</td>
                <td class="px-6 py-3">Manajemen Proyek TI</td>
                <td class="px-6 py-3">Manajemen</td>
                <td class="px-6 py-3">-</td>
                <td class="px-6 py-3 text-red-600 font-semibold">Tidak Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 6 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-006</td>
                <td class="px-6 py-3">Rak-006</td>
                <td class="px-6 py-3">Statistika untuk Penelitian</td>
                <td class="px-6 py-3">Statistik</td>
                <td class="px-6 py-3">14</td>
                <td class="px-6 py-3 text-green-600 font-semibold">Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 7 -->
            <tr class="border-b">
                <td class="px-6 py-3">BK-007</td>
                <td class="px-6 py-3">Rak-007</td>
                <td class="px-6 py-3">Pengantar Kecerdasan Buatan</td>
                <td class="px-6 py-3">AI</td>
                <td class="px-6 py-3">23</td>
                <td class="px-6 py-3 text-green-600 font-semibold">Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

            <!-- 8 -->
            <tr>
                <td class="px-6 py-3">BK-008</td>
                <td class="px-6 py-3">Rak-008</td>
                <td class="px-6 py-3">Sejarah Nusantara Kuno</td>
                <td class="px-6 py-3">Budaya</td>
                <td class="px-6 py-3">8</td>
                <td class="px-6 py-3 text-red-600 font-semibold">Tidak Tersedia</td>
                <td class="px-6 py-3 flex gap-3">
                    <img src="{{ asset('icons/info.png') }}" class="w-5">
                    <img src="{{ asset('icons/edit.png') }}" class="w-5">
                    <img src="{{ asset('icons/delete.png') }}" class="w-5">
                </td>
            </tr>

        </tbody>
    </table>
</div>

    <!-- ============================ PAGINATION ============================ -->
    <div class="flex items-center justify-center space-x-4 mt-6">

        <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">
            ‹
        </button>

        <div class="w-7 h-7 flex items-center justify-center bg-[#A63A2D] text-white rounded-full">
            1
        </div>

        <span class="text-gray-800 text-lg">2</span>
        <span class="text-gray-800 text-lg">...</span>

        <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">
            ›
        </button>

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