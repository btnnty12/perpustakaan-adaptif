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

<<<<<<< Updated upstream
        <div class="menu-item"><img src="{{ asset('images/icon-home.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-anggota.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-buku.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-grafik.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-user.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-setting.png') }}" class="w-7"></div>

    </div>

    <img src="{{ asset('images/icon-logout.png') }}" class="w-7 mt-auto mb-4">
=======
        <a href="{{ route('admin') }}" class="menu-item"><x-icon name="home" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('data.anggota') }}" class="menu-item"><x-icon name="anggota" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('kelola.buku') }}" class="menu-item"><x-icon name="buku" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('laporan-peminjaman') }}" class="menu-item"><x-icon name="grafik" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('kelola-user') }}" class="menu-item"><x-icon name="user" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('pengaturan') }}" class="menu-item"><x-icon name="setting" class="w-7 h-7 text-white" /></a>

    </div>

    <a href="{{ url('/logout') }}" class="menu-item mt-auto mb-4"><x-icon name="logout" class="w-7 h-7 text-white" /></a>
>>>>>>> Stashed changes
</div>

<!-- ============================ CONTENT ============================ -->
 <div class="flex-1 py-6 px-10">

<!-- TOPBAR -->
<div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">

    <!-- Divider kiri -->
    <div class="border-l border-white h-6"></div>

    <!-- Icon pesan -->
<<<<<<< Updated upstream
    <img src="{{ asset('images/icon-email.png') }}" class="w-6">

    <!-- Icon notif -->
    <img src="{{ asset('images/icon-notification.png') }}" class="w-6">
=======
    <x-icon name="email" class="w-6 h-6 text-black" />

    <!-- Icon notif -->
    <x-icon name="notification" class="w-6 h-6 text-black" />
>>>>>>> Stashed changes

    <!-- Divider kanan -->
    <div class="border-l border-white h-6"></div>

    <!-- Profile -->
    <div class="flex items-center space-x-2">
        <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
            FA
        </div>
        <span class="text-black font-medium">Fayza Azzahra</span>
<<<<<<< Updated upstream
        <img src="{{ asset('images/icon-down-arrow.png') }}" class="w-4 ml-1">
=======
        <x-icon name="arrow-down" class="w-4 h-4 ml-1 text-black" />
>>>>>>> Stashed changes
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

        <input type="text" id="searchInput" placeholder="Search"
               class="filter-search shadow p-3 rounded-lg" onkeyup="filterTable()">

        <select id="kategoriFilter" class="filter-select shadow" onchange="filterTable()">
            <option value="">Semua Kategori</option>
            <option value="Bahasa">Bahasa</option>
            <option value="Pemrograman">Pemrograman</option>
            <option value="Psikologi">Psikologi</option>
            <option value="Akuntansi">Akuntansi</option>
            <option value="Manajemen">Manajemen</option>
            <option value="Statistik">Statistik</option>
            <option value="AI">AI</option>
            <option value="Budaya">Budaya</option>
        </select>

        <select id="statusFilter" class="filter-select shadow" onchange="filterTable()">
            <option value="">Semua Status</option>
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
        </select>

        <button class="btn-search" onclick="filterTable()">Search</button>
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
            <tr class="border-b buku-row" data-judul="bahasa inggris untuk akademik" data-kategori="Bahasa" data-status="Tersedia">
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
            <tr class="border-b buku-row" data-judul="algoritma dan struktur data" data-kategori="Pemrograman" data-status="Tidak Tersedia">
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
            <tr class="border-b buku-row" data-judul="psikologi remaja modern" data-kategori="Psikologi" data-status="Tersedia">
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
            <tr class="border-b buku-row" data-judul="dasar-dasar akuntansi" data-kategori="Akuntansi" data-status="Tersedia">
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
            <tr class="border-b buku-row" data-judul="manajemen proyek ti" data-kategori="Manajemen" data-status="Tidak Tersedia">
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
            <tr class="border-b buku-row" data-judul="statistika untuk penelitian" data-kategori="Statistik" data-status="Tersedia">
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
            <tr class="border-b buku-row" data-judul="pengantar kecerdasan buatan" data-kategori="AI" data-status="Tersedia">
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
            <tr class="buku-row" data-judul="sejarah nusantara kuno" data-kategori="Budaya" data-status="Tidak Tersedia">
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
    <div id="noResults" class="hidden text-center py-8 text-gray-500">
        <p>Tidak ada buku yang ditemukan.</p>
    </div>
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

// ======================================================
// ALGORITMA STRING MATCHING
// ======================================================

// 1. Brute Force Algorithm
function bruteForce(text, pattern) {
    if (!text || !pattern) return [];
    
    const n = text.length;
    const m = pattern.length;
    const results = [];
    
    if (m === 0 || m > n) return results;
    
    for (let i = 0; i <= n - m; i++) {
        let j = 0;
        while (j < m && text[i + j] === pattern[j]) {
            j++;
        }
        if (j === m) {
            results.push(i);
        }
    }
    return results;
}

// 2. Knuth-Morris-Pratt (KMP) Algorithm
function kmpLps(pattern) {
    const m = pattern.length;
    const lps = new Array(m).fill(0);
    let len = 0;
    let i = 1;
    
    while (i < m) {
        if (pattern[i] === pattern[len]) {
            len++;
            lps[i] = len;
            i++;
        } else {
            if (len !== 0) {
                len = lps[len - 1];
            } else {
                lps[i] = 0;
                i++;
            }
        }
    }
    return lps;
}

function kmp(text, pattern) {
    if (!text || !pattern) return [];
    
    const n = text.length;
    const m = pattern.length;
    const results = [];
    
    if (m === 0 || m > n) return results;
    
    const lps = kmpLps(pattern);
    let i = 0;
    let j = 0;
    
    while (i < n) {
        if (text[i] === pattern[j]) {
            i++;
            j++;
            if (j === m) {
                results.push(i - j);
                j = lps[j - 1];
            }
        } else {
            if (j !== 0) {
                j = lps[j - 1];
            } else {
                i++;
            }
        }
    }
    return results;
}

// 3. Boyer-Moore Algorithm (Simplified)
function boyerMoore(text, pattern) {
    if (!text || !pattern) return [];
    
    const n = text.length;
    const m = pattern.length;
    const results = [];
    
    if (m === 0 || m > n) return results;
    
    // Build bad character table
    const bad = new Array(256).fill(-1);
    for (let i = 0; i < m; i++) {
        bad[pattern.charCodeAt(i)] = i;
    }
    
    let shift = 0;
    while (shift <= n - m) {
        let j = m - 1;
        
        while (j >= 0 && pattern[j] === text[shift + j]) {
            j--;
        }
        
        if (j < 0) {
            results.push(shift);
            shift += (shift + m < n) ? m - (bad[text.charCodeAt(shift + m)] !== undefined ? bad[text.charCodeAt(shift + m)] : -1) : 1;
        } else {
            const bc = bad[text.charCodeAt(shift + j)];
            shift += Math.max(1, j - bc);
        }
    }
    return results;
}

// Fungsi untuk memilih algoritma terbaik berdasarkan panjang pattern
function selectBestAlgorithm(pattern) {
    if (!pattern) return 'bf';
    const len = pattern.length;
    if (len <= 3) return 'bf'; // Brute Force untuk pattern pendek
    if (len <= 10) return 'kmp'; // KMP untuk pattern sedang
    return 'bm'; // Boyer-Moore untuk pattern panjang
}

// Fungsi pencarian dengan algoritma
function searchWithAlgorithm(text, pattern, algorithm) {
    if (!text || !pattern) return [];
    
    switch(algorithm) {
        case 'bf':
            return bruteForce(text, pattern);
        case 'kmp':
            return kmp(text, pattern);
        case 'bm':
            return boyerMoore(text, pattern);
        default:
            return bruteForce(text, pattern);
    }
}

// ======================================================
// FUNGSI FILTER TABLE DENGAN ALGORITMA
// ======================================================
let searchTimeout;

function filterTable() {
    // Debounce untuk menghindari terlalu banyak eksekusi
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        executeSearch();
    }, 150); // Delay 150ms
}

function executeSearch() {
    const searchInput = document.getElementById('searchInput');
    const kategoriFilter = document.getElementById('kategoriFilter');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('.buku-row');
    const noResults = document.getElementById('noResults');
    
    if (!searchInput || !rows.length) return;
    
    const searchValue = searchInput.value.trim().toLowerCase();
    const kategoriValue = kategoriFilter ? kategoriFilter.value : '';
    const statusValue = statusFilter ? statusFilter.value : '';
    let visibleCount = 0;

    // Jika tidak ada input search, tampilkan semua berdasarkan filter
    if (!searchValue && !kategoriValue && !statusValue) {
        rows.forEach(row => {
            row.style.display = '';
            visibleCount++;
        });
        if (noResults) noResults.classList.add('hidden');
        return;
    }

    // Pilih algoritma terbaik berdasarkan panjang pattern
    const algorithm = selectBestAlgorithm(searchValue);
    
    // Mulai timer untuk mengukur performa
    const startTime = performance.now();

    // Lakukan pencarian dengan algoritma string matching
    rows.forEach(row => {
        const judul = row.getAttribute('data-judul') || '';
        const kategori = row.getAttribute('data-kategori') || '';
        const status = row.getAttribute('data-status') || '';
        
        let matchesSearch = true;
        if (searchValue) {
            const judulMatches = searchWithAlgorithm(judul, searchValue, algorithm);
            matchesSearch = judulMatches.length > 0;
        }
        
        const matchesKategori = !kategoriValue || kategori === kategoriValue;
        const matchesStatus = !statusValue || status === statusValue;
        
        if (matchesSearch && matchesKategori && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Tampilkan pesan jika tidak ada hasil
    if (noResults) {
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }
}
</script>

</body>
</html>