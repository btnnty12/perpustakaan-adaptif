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
        <div class="menu-item"><img src="{{ asset('icons/home.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('icons/book.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('icons/list.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('icons/user.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('icons/user.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('icons/setting.png') }}" class="w-7"></div>
    </div>
    <img src="{{ asset('icons/logout.png') }}" class="w-7 mt-auto mb-4">
</div>

<!-- ============================ CONTENT ============================ -->
<div class="flex-1 py-6 px-10">

    <!-- TOPBAR -->
    <div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">
        <div class="border-l border-white h-6"></div>
        <img src="{{ asset('icons/mail.png') }}" class="w-6">
        <img src="{{ asset('icons/bell.png') }}" class="w-6">
        <div class="border-l border-white h-6"></div>
        <div class="flex items-center space-x-2">
            <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">FA</div>
            <span class="text-black font-medium">Fayza Azzahra</span>
            <img src="{{ asset('icons/arrow-down.png') }}" class="w-4 ml-1">
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
            <input type="text" placeholder="Search" class="filter-search shadow p-3 rounded-lg">
            <select class="filter-select shadow">
                <option>Kategori</option>
            </select>
            <input type="date" class="filter-select shadow">
            <button class="btn-search">Search</button>
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
                <tr class="border-b">
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
                <tr class="border-b">
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
                <tr class="border-b">
                    <td class="px-6 py-3">TRX-003</td>
                    <td class="px-6 py-3">Yuval Noah Harari</td>
                    <td class="px-6 py-3">Psikologi Remaja Modern</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">08/11/2025</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">Dikembalikan</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b">
                    <td class="px-6 py-3">TRX-004</td>
                    <td class="px-6 py-3">Malcolm Gladwell</td>
                    <td class="px-6 py-3">Dasar-Dasar Akuntansi</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 text-blue-600 font-semibold">Dipinjam</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b">
                    <td class="px-6 py-3">TRX-005</td>
                    <td class="px-6 py-3">Cal Newport</td>
                    <td class="px-6 py-3">Manajemen Proyek TI</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">10/11/2025</td>
                    <td class="px-6 py-3 text-red-600 font-semibold">Terlambat</td>
                    <td class="px-6 py-3">Rp. 10.000</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b">
                    <td class="px-6 py-3">TRX-006</td>
                    <td class="px-6 py-3">Robert T. Kiyosaki</td>
                    <td class="px-6 py-3">Statistika untuk Penelitian</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">08/11/2025</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">Dikembalikan</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b">
                    <td class="px-6 py-3">TRX-007</td>
                    <td class="px-6 py-3">Stephen R. Covey</td>
                    <td class="px-6 py-3">Etika Profesi dan Hukum Siswa</td>
                    <td class="px-6 py-3">01/11/2025</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 text-blue-600 font-semibold">Dipinjam</td>
                    <td class="px-6 py-3">-</td>
                    <td class="px-6 py-3 flex gap-3"><img src="{{ asset('icons/search.png') }}" class="w-5"></td>
                </tr>
                <tr class="border-b">
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
</body>
</html>
