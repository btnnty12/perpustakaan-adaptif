<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6d47f] flex">

<style>
#indicator {
    position: absolute;
    left: 0;
    top: 415px;
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

.section-wrapper {
    width: 100%;
    padding-left: 25px;
    padding-right: 40px;
    margin-top: 20px;
}

.stats-row {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-top: 25px;
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
        <a href="{{ route('admin') }}" class="menu-item"><x-icon name="home" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('data.anggota') }}" class="menu-item"><x-icon name="anggota" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('kelola.buku') }}" class="menu-item"><x-icon name="buku" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('laporan-peminjaman') }}" class="menu-item"><x-icon name="grafik" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('kelola-user') }}" class="menu-item"><x-icon name="user" class="w-7 h-7 text-white" /></a>
        <a href="{{ route('pengaturan') }}" class="menu-item"><x-icon name="setting" class="w-7 h-7 text-white" /></a>
    </div>
    <a href="{{ url('/logout') }}" class="menu-item mt-auto mb-4"><x-icon name="logout" class="w-7 h-7 text-white" /></a>
</div>

<!-- ============================ CONTENT ============================ -->
<div class="flex-1 py-6 px-10">

    <!-- TOPBAR -->
    <div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">
        <div class="border-l border-white h-6"></div>
        <x-icon name="email" class="w-6 h-6 text-black" />
        <x-icon name="notification" class="w-6 h-6 text-black" />
        <div class="border-l border-white h-6"></div>
        <div class="flex items-center space-x-2">
            <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">FA</div>
            <span class="text-black font-medium">Fayza Azzahra</span>
            <x-icon name="arrow-down" class="w-4 h-4 ml-1 text-black" />
        </div>
    </div>

    <div class="w-full border-b-2 border-white mb-6"></div>

    <div class="section-wrapper">
        <h1 class="text-4xl font-bold">Laporan Peminjaman !</h1>
        <p class="text-gray-700 mt-1">Cek siapa saja yang sedang meminjam, mengembalikan, atau terlambat mengembalikan buku.</p>

        <!-- STATISTIK -->
        <div class="stats-row">
            <div class="stat-card">
                <h2 class="text-4xl font-bold">255</h2>
                <p>Total Buku</p>
            </div>
            <div class="stat-card">
                <h2 class="text-4xl font-bold">150</h2>
                <p>Sedang Dipinjam</p>
            </div>
            <div class="stat-card">
                <h2 class="text-4xl font-bold">23</h2>
                <p>Terlambat</p>
            </div>
            <div class="stat-card">
                <h2 class="text-4xl font-bold">Rp. 320.000</h2>
                <p>Total Denda Terkumpul</p>
            </div>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-row">
            <input type="text" id="searchInput" placeholder="Search" class="filter-search shadow p-3 rounded-lg" onkeyup="filterTable()">
            <select id="statusFilter" class="filter-select shadow" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Dikembalikan">Dikembalikan</option>
                <option value="Terlambat">Terlambat</option>
            </select>
            <input type="date" id="dateFilter" class="filter-select shadow" onchange="filterTable()">
            <button class="btn-search" onclick="filterTable()">Search</button>
        </div>
    </div>

    <!-- ============================ TABLE ============================ -->
    <div class="mt-8 bg-white rounded-lg shadow overflow-hidden w-[97%]">
        <table class="w-full text-left">
            <thead class="bg-[#b54a38] text-white">
                <tr>
                    <th class="px-6 py-4">ID Transaksi</th>
                    <th class="px-6 py-4">Nama Anggota</th>
                    <th class="px-6 py-4">Judul Buku</th>
                    <th class="px-6 py-4">Tanggal Pinjam</th>
                    <th class="px-6 py-4">Tanggal Kembali</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Denda</th>
                    <th class="px-10 py-5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b pinjaman-row" data-nama="simon sinek" data-judul="pemrograman web dengan" data-status="Dikembalikan" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-001</td>
                    <td class="px-6 py-3">Simon Sinek</td>
                    <td class="px-6 py-3">Pemrograman Web dengan ...</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">08/11/2025</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">Dikembalikan</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3">
                        <img src="{{ asset('icons/search.png') }}" class="w-5">
                    </td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="cal newport" data-judul="manajemen proyek ti" data-status="Terlambat" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-002</td>
                    <td class="px-6 py-3">Cal Newport</td>
                    <td class="px-6 py-3">Manajemen Proyek TI</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">10/11/2025</td>
                    <td class="px-6 py-3 text-red-600 font-semibold">Terlambat</td>
                    <td class="px-6 py-3">Rp. 10.000</td>
                    <td class="px-6 py-3 flex gap-3">
                        <img src="{{ asset('icons/search.png') }}" class="w-5">
                    </td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="yuval noah harari" data-judul="psikologi remaja modern" data-status="Dikembalikan" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-003</td>
                    <td class="px-6 py-3">Yuval Noah Harari</td>
                    <td class="px-6 py-3">Psikologi Remaja Modern</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">08/11/2025</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">Dikembalikan</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="malcolm gladwell" data-judul="dasar-dasar akuntansi" data-status="Dipinjam" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-004</td>
                    <td class="px-6 py-3">Malcolm Gladwell</td>
                    <td class="px-6 py-3">Dasar-Dasar Akuntansi</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 text-blue-600 font-semibold">Dipinjam</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="cal newport" data-judul="manajemen proyek ti" data-status="Terlambat" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-005</td>
                    <td class="px-6 py-3">Cal Newport</td>
                    <td class="px-6 py-3">Manajemen Proyek TI</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">10/11/2025</td>
                    <td class="px-6 py-3 text-red-600 font-semibold">Terlambat</td>
                    <td class="px-6 py-3">Rp. 10.000</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="robert t. kiyosaki" data-judul="statistika untuk penelitian" data-status="Dikembalikan" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-006</td>
                    <td class="px-6 py-3">Robert T. Kiyosaki</td>
                    <td class="px-6 py-3">Statistika untuk Penelitian</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">08/11/2025</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">Dikembalikan</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="stephen r. covey" data-judul="etika profesi dan hukum siswa" data-status="Dipinjam" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-007</td>
                    <td class="px-6 py-3">Stephen R. Covey</td>
                    <td class="px-6 py-3">Etika Profesi dan Hukum Siswa</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 text-blue-600 font-semibold">Dipinjam</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b pinjaman-row" data-nama="haruki murakami" data-judul="desain ui/ux untuk pemula" data-status="Dikembalikan" data-tanggal="2025-11-01">
                    <td class="px-6 py-3">TRX-008</td>
                    <td class="px-6 py-3">Haruki Murakami</td>
                    <td class="px-6 py-3">Desain UI/UX untuk Pemula</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">15/11/2025</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">Dikembalikan</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <!-- Tambahkan row lain sesuai data -->
            </tbody>
        </table>
        <div id="noResults" class="hidden text-center py-8 text-gray-500">
            <p>Tidak ada data peminjaman yang ditemukan.</p>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-center space-x-4 mt-6">
        <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">‹</button>
        <div class="w-7 h-7 flex items-center justify-center bg-[#A63A2D] text-white rounded-full">1</div>
        <span class="text-gray-800 text-lg">2</span>
        <span class="text-gray-800 text-lg">...</span>
        <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">›</button>
    </div>
</div>

<script>
document.querySelectorAll('.menu-item').forEach((item, index) => {
    item.addEventListener('click', function () {

        // PINDAHKAN INDIKATOR
        document.getElementById('indicator').style.top = (204 + index * 95) + 'px';

        // ARAHKAN KE HALAMAN SESUAI MENU
        if (index === 0) window.location.href = "/admin";              // Dashboard
        if (index === 1) window.location.href = "/data-anggota";       // Data Anggota
        if (index === 2) window.location.href = "/kelola-buku";        // Kelola Buku
        if (index === 3) window.location.href = "/laporan-peminjaman"; // Laporan Grafik/Peminjaman
        if (index === 4) window.location.href = "/kelola-user";        // Kelola User
        if (index === 5) window.location.href = "/pengaturan";         // Pengaturan
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
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        executeSearch();
    }, 150);
}

function executeSearch() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const rows = document.querySelectorAll('.pinjaman-row');
    const noResults = document.getElementById('noResults');
    
    if (!searchInput || !rows.length) return;
    
    const searchValue = searchInput.value.trim().toLowerCase();
    const statusValue = statusFilter ? statusFilter.value : '';
    const dateValue = dateFilter ? dateFilter.value : '';
    let visibleCount = 0;

    // Jika tidak ada input search, tampilkan semua berdasarkan filter
    if (!searchValue && !statusValue && !dateValue) {
        rows.forEach(row => {
            row.style.display = '';
            visibleCount++;
        });
        if (noResults) noResults.classList.add('hidden');
        return;
    }

    // Pilih algoritma terbaik berdasarkan panjang pattern
    const algorithm = selectBestAlgorithm(searchValue);

    // Lakukan pencarian dengan algoritma string matching
    rows.forEach(row => {
        const nama = row.getAttribute('data-nama') || '';
        const judul = row.getAttribute('data-judul') || '';
        const status = row.getAttribute('data-status') || '';
        const tanggal = row.getAttribute('data-tanggal') || '';
        
        let matchesSearch = true;
        if (searchValue) {
            const namaMatches = searchWithAlgorithm(nama, searchValue, algorithm);
            const judulMatches = searchWithAlgorithm(judul, searchValue, algorithm);
            matchesSearch = namaMatches.length > 0 || judulMatches.length > 0;
        }

        const matchesStatus = !statusValue || status === statusValue;
        const matchesDate = !dateValue || tanggal === dateValue;
        
        if (matchesSearch && matchesStatus && matchesDate) {
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