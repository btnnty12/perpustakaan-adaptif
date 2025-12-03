<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f6d47f]">

    <div class="flex">
<style>
#indicator {
    position: absolute;
    left: 0;
    top: 204px;
    width: 75px;
    height: 38px;
    background-color: #F7DE68;
    border-radius: 0 20px 20px 0;
    box-shadow: 0 6px 10px rgba(0,0,0,0.35);
    transition: 0.3s ease-in-out;
    z-index: 0; /* indikator di belakang */
}

/* wrapper menu */
.menu-item {
    position: relative;
    z-index: 5; /* menu di atas indikator */
}

/* gambar icon */
.menu-item img {
    width: 26px;
    height: 26px;
}
</style>

<!-- SIDEBAR -->
<div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6">

   <!-- Indikator aktif -->
    <div id="indicator"></div>

    <!-- MENU ATAS -->
    <div class="flex flex-col items-center space-y-20 pt-20">

    <div class="menu-item"><img src="{{ asset('icons/home.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('icons/book.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('icons/list.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('icons/user.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('icons/setting.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('icons/setting.png') }}" class="w-7"></div>

</div>

    <!-- LOGOUT PALING BAWAH -->
    <img src="{{ asset('icons/logout.png') }}" class="w-7 mt-auto mb-4">
</div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 py-6 px-10">

<!-- TOPBAR -->
<div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">

    <!-- Divider kiri -->
    <div class="border-l border-white h-6"></div>

    <!-- Icon pesan -->
    <img src="{{ asset('icons/mail.png') }}" class="w-6">

    <!-- Icon notif -->
    <img src="{{ asset('icons/bell.png') }}" class="w-6">

    <!-- Divider kanan -->
    <div class="border-l border-white h-6"></div>

    <!-- Profile -->
    <div class="flex items-center space-x-2">
        <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
            FA
        </div>
        <span class="text-black font-medium">Fayza Azzahra</span>
        <img src="{{ asset('icons/arrow-down.png') }}" class="w-4 ml-1">
    </div>

</div>

<!-- GARIS PEMBATAS PANJANG -->
<div class="w-full border-b-2 border-white mb-6"></div>

            <!-- TITLE -->
            <h1 class="text-3xl font-bold text-[#7c1d0f] mb-1">Data Anggota !</h1>
            <p class="text-sm text-gray-700 mb-6">Pantau dan atur data anggota perpustakaan untuk memastikan informasi terbaru.</p>

            <!-- STATISTIC CARDS -->
            <div class="grid grid-cols-4 gap-6 mb-8">

                <div class="bg-[#b94a36] text-white rounded-lg p-6 text-center">
                    <h2 class="text-4xl font-bold">155</h2>
                    <p>Total Anggota</p>
                </div>

                <div class="bg-[#b94a36] text-white rounded-lg p-6 text-center">
                    <h2 class="text-4xl font-bold">100</h2>
                    <p>Anggota Aktif</p>
                </div>

                <div class="bg-[#b94a36] text-white rounded-lg p-6 text-center">
                    <h2 class="text-4xl font-bold">45</h2>
                    <p>Anggota Nonaktif</p>
                </div>

                <div class="bg-[#b94a36] text-white rounded-lg p-6 text-center">
                    <h2 class="text-4xl font-bold">10</h2>
                    <p>Anggota Baru Bulan Ini</p>
                </div>

            </div>

            <!-- SEARCH + FILTER -->
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg px-4 py-2 flex items-center">
                    <img src="{{ asset('icons/search.png') }}" class="w-5 mr-3">
                    <input type="text" placeholder="Search" class="w-full outline-none">
                </div>

                <div class="bg-white rounded-lg px-4 py-2 flex items-center">
                    <span class="text-gray-500">Status</span>
                </div>

                <div class="bg-white rounded-lg px-4 py-2 flex items-center">
                    <span class="text-gray-500">19/10/2025</span>
                </div>
            </div>

            <!-- TABEL -->
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <table class="w-full text-left">
                    <thead class="bg-[#b94a36] text-white">
                        <tr>
                            <th class="px-4 py-3">ID Anggota</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Judul Buku</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Denda</th>
                            <th class="px-4 py-3">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- 1 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT001</td>
                            <td class="px-4 py-3">Siti Nurfadila</td>
                            <td class="px-4 py-3">siti@gmail.com</td>
                            <td class="px-4 py-3">Pemrograman Web Dasar</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 2 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT002</td>
                            <td class="px-4 py-3">Rangga Saputra</td>
                            <td class="px-4 py-3">rangga@gmail.com</td>
                            <td class="px-4 py-3">Matematika Ekonomi</td>
                            <td class="px-4 py-3 text-red-600 font-semibold">Nonaktif</td>
                            <td class="px-4 py-3">Rp 15.000</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 3 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT003</td>
                            <td class="px-4 py-3">Budi Hartanto</td>
                            <td class="px-4 py-3">budi@gmail.com</td>
                            <td class="px-4 py-3">Fisika Dasar</td>
                            <td class="px-4 py-3 text-yellow-600 font-semibold">Menunggu Konfirmasi</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 4 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT004</td>
                            <td class="px-4 py-3">Dewi Kartika</td>
                            <td class="px-4 py-3">dewi@gmail.com</td>
                            <td class="px-4 py-3">Sistem Informasi</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 5 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT005</td>
                            <td class="px-4 py-3">Novi Amelia</td>
                            <td class="px-4 py-3">novi@gmail.com</td>
                            <td class="px-4 py-3">Analisis Data</td>
                            <td class="px-4 py-3 text-red-600 font-semibold">Nonaktif</td>
                            <td class="px-4 py-3">Rp 8.000</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 6 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT006</td>
                            <td class="px-4 py-3">Andi Pratama</td>
                            <td class="px-4 py-3">andi@gmail.com</td>
                            <td class="px-4 py-3">Statistik Dasar</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 7 -->
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT007</td>
                            <td class="px-4 py-3">Lisa Marlina</td>
                            <td class="px-4 py-3">lisa@gmail.com</td>
                            <td class="px-4 py-3">Pengantar Bisnis</td>
                            <td class="px-4 py-3 text-yellow-600 font-semibold">Menunggu Konfirmasi</td>
                            <td class="px-4 py-3">Rp 5.000</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <!-- 8 -->
                        <tr>
                            <td class="px-4 py-3">AGT008</td>
                            <td class="px-4 py-3">Syahrul Ramadhan</td>
                            <td class="px-4 py-3">syahrul@gmail.com</td>
                            <td class="px-4 py-3">Kalkulus 1</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('icons/edit.png') }}" class="w-5">
                                <img src="{{ asset('icons/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="flex items-center justify-center space-x-4 mt-6">

    <!-- Tombol Prev -->
    <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">
        ‹
    </button>

    <!-- Halaman Aktif -->
    <div class="w-7 h-7 flex items-center justify-center bg-[#A63A2D] text-white rounded-full">
        1
    </div>

    <!-- Halaman Lain -->
    <span class="text-gray-800 text-lg">2</span>

    <!-- Titik Titik -->
    <span class="text-gray-800 text-lg">...</span>

    <!-- Tombol Next -->
    <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">
        ›
    </button>

</div>

</body>
</html>