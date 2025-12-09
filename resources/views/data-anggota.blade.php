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

    <div class="menu-item"><img src="{{ asset('images/icon-home.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('images/icon-kelola-anggota.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('images/icon-kelola-buku.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('images/icon-grafik.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('images/icon-kelola-user.png') }}" class="w-7"></div>
    <div class="menu-item"><img src="{{ asset('images/icon-setting.png') }}" class="w-7"></div>

</div>

    <!-- LOGOUT PALING BAWAH -->
    <img src="{{ asset('images/icon-logout.png') }}" class="w-7 mt-auto mb-4">
</div>

        <!-- MAIN CONTENT -->
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
                    <img src="{{ asset('images/icon-search-kecil.png') }}" class="w-5 mr-3">
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
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Judul Buku</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Denda</th>
                            <th class="px-4 py-3">Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-3">AGT001</td>
                            <td class="px-4 py-3">19/10/2025</td>
                            <td class="px-4 py-3">Siti Nurfadila</td>
                            <td class="px-4 py-3">siti@gmail.com</td>
                            <td class="px-4 py-3">Pemrograman Web Dasar</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3">AGT002</td>
                            <td class="px-4 py-3">20/10/2025</td>
                            <td class="px-4 py-3">Rangga Saputra</td>
                            <td class="px-4 py-3">rangga@gmail.com</td>
                            <td class="px-4 py-3">Matematika Ekonomi</td>
                            <td class="px-4 py-3 text-red-600 font-semibold">Nonaktif</td>
                            <td class="px-4 py-3">Rp 15.000</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3">AGT003</td>
                            <td class="px-4 py-3">21/10/2025</td>
                            <td class="px-4 py-3">Budi Hartanto</td>
                            <td class="px-4 py-3">budi@gmail.com</td>
                            <td class="px-4 py-3">Fisika Dasar</td>
                            <td class="px-4 py-3 text-yellow-600 font-semibold">Menunggu Konfirmasi</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3">AGT004</td>
                            <td class="px-4 py-3">22/10/2025</td>
                            <td class="px-4 py-3">Dewi Kartika</td>
                            <td class="px-4 py-3">dewi@gmail.com</td>
                            <td class="px-4 py-3">Sistem Informasi</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3">AGT005</td>
                            <td class="px-4 py-3">23/10/2025</td>
                            <td class="px-4 py-3">Novi Amelia</td>
                            <td class="px-4 py-3">novi@gmail.com</td>
                            <td class="px-4 py-3">Analisis Data</td>
                            <td class="px-4 py-3 text-red-600 font-semibold">Nonaktif</td>
                            <td class="px-4 py-3">Rp 8.000</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3">AGT006</td>
                            <td class="px-4 py-3">24/10/2025</td>
                            <td class="px-4 py-3">Andi Pratama</td>
                            <td class="px-4 py-3">andi@gmail.com</td>
                            <td class="px-4 py-3">Statistik Dasar</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-4 py-3">AGT007</td>
                            <td class="px-4 py-3">25/10/2025</td>
                            <td class="px-4 py-3">Lisa Marlina</td>
                            <td class="px-4 py-3">lisa@gmail.com</td>
                            <td class="px-4 py-3">Pengantar Bisnis</td>
                            <td class="px-4 py-3 text-yellow-600 font-semibold">Menunggu Konfirmasi</td>
                            <td class="px-4 py-3">Rp 5.000</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>

                        <tr>
                            <td class="px-4 py-3">AGT008</td>
                            <td class="px-4 py-3">26/10/2025</td>
                            <td class="px-4 py-3">Syahrul Ramadhan</td>
                            <td class="px-4 py-3">syahrul@gmail.com</td>
                            <td class="px-4 py-3">Kalkulus 1</td>
                            <td class="px-4 py-3 text-green-600 font-semibold">Aktif</td>
                            <td class="px-4 py-3">Rp 0</td>
                            <td class="px-4 py-3 flex gap-3">
                                <img src="{{ asset('images/edit.png') }}" class="w-5">
                                <img src="{{ asset('images/delete.png') }}" class="w-5">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="flex flex-col items-center justify-center space-y-3 mt-6">
                <div class="flex items-center space-x-4">
                    <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">‹</button>
                    <div class="w-7 h-7 flex items-center justify-center bg-[#A63A2D] text-white rounded-full">1</div>
    <span class="text-gray-800 text-lg">2</span>
    <span class="text-gray-800 text-lg">...</span>
                    <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">›</button>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-[#A63A2D]"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                    <div class="w-3 h-3 rounded-full bg-gray-300"></div>
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
</script>


<script>
// --- SEARCH, STATUS, TANGGAL FILTER ---
const searchInput = document.querySelector('input[placeholder="Search"]');
const statusFilter = document.querySelectorAll('.grid-cols-3 div:nth-child(2)');
const dateFilter = document.querySelectorAll('.grid-cols-3 div:nth-child(3)');
const tableRows = document.querySelectorAll('tbody tr');

// Buat dropdown status dan input tanggal
statusFilter[0].innerHTML = `
    <select id="statusSelect" class="w-full outline-none text-gray-500">
        <option value="">Semua Status</option>
        <option value="Aktif">Aktif</option>
        <option value="Nonaktif">Nonaktif</option>
        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
    </select>
`;

dateFilter[0].innerHTML = `
    <input type="date" id="dateSelect" class="w-full outline-none text-gray-500">
`;

// Fungsi filter tabel
function filterTable() {
    const searchValue = searchInput.value.toLowerCase();
    const statusValue = document.getElementById('statusSelect').value;
    const dateValue = document.getElementById('dateSelect').value; // format yyyy-mm-dd

    tableRows.forEach(row => {
        const name = row.cells[2].textContent.toLowerCase(); // kolom Nama
        const email = row.cells[3].textContent.toLowerCase(); // kolom Email
        const status = row.cells[5].textContent; // kolom Status
        const tanggalCell = row.cells[1].textContent; // kolom Tanggal
        const tanggal = new Date(tanggalCell.split('/').reverse().join('-')).toISOString().split('T')[0]; // convert ke yyyy-mm-dd

        const matchesSearch = name.includes(searchValue) || email.includes(searchValue);
        const matchesStatus = statusValue === "" || status === statusValue;
        const matchesDate = dateValue === "" || tanggal === dateValue;

        row.style.display = (matchesSearch && matchesStatus && matchesDate) ? "" : "none";
    });
}

// Event listener
searchInput.addEventListener('input', filterTable);
document.getElementById('statusSelect').addEventListener('change', filterTable);
document.getElementById('dateSelect').addEventListener('change', filterTable);
</script>

<!-- Update kolom Opsi di tbody dengan icon -->
<script>
// Tambahkan icon "Detail" dan "Hapus" dengan event listener
document.querySelectorAll('tbody tr').forEach((row) => {
    const opsiCell = row.querySelector('td:last-child');
    opsiCell.innerHTML = `
        <img src="{{ asset('images/icon-edit-opsi.png') }}" class="w-5 cursor-pointer mr-2" title="Detail">
        <img src="{{ asset('images/icon-delete-opsi.png') }}" class="w-5 cursor-pointer" title="Hapus">
    `;

    // EVENT DETAIL
    opsiCell.querySelector('img:nth-child(1)').addEventListener('click', () => {
        const data = {
            id: row.cells[0].textContent,
            tanggal: row.cells[1].textContent,
            nama: row.cells[2].textContent,
            email: row.cells[3].textContent,
            buku: row.cells[4].textContent,
            status: row.cells[5].textContent,
            denda: row.cells[6].textContent
        };
        alert(`Detail Anggota:\n\nID: ${data.id}\nTanggal: ${data.tanggal}\nNama: ${data.nama}\nEmail: ${data.email}\nJudul Buku: ${data.buku}\nStatus: ${data.status}\nDenda: ${data.denda}`);
    });

    // EVENT DELETE
    opsiCell.querySelector('img:nth-child(2)').addEventListener('click', () => {
        const confirmDelete = confirm(`Apakah Anda yakin ingin menghapus anggota "${row.cells[2].textContent}"?`);
        if(confirmDelete) {
            row.remove();
            alert('Data berhasil dihapus.');
        }
    });
});
</script>

</body>
</html>