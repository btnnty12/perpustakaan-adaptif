<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengembalian Buku</title>

    <!-- Tailwind Online -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/a2e0e6ad65.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-gradient-to-br from-yellow-200 to-yellow-300 min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-56 bg-[#B1321B] text-white flex flex-col py-6">
        <div class="flex flex-col items-center space-y-10 text-2xl">

            <a href="#" class="hover:opacity-80"><i class="fas fa-home"></i></a>
            <a href="#" class="hover:opacity-80"><i class="fas fa-search"></i></a>
            <a href="#" class="hover:opacity-80"><i class="fas fa-book"></i></a>

            <a href="#" class="bg-yellow-300 rounded-xl px-4 py-3 text-orange-800 shadow-md">
                <i class="fas fa-book-open text-xl"></i>
            </a>

            <a href="#" class="hover:opacity-80"><i class="fas fa-heart"></i></a>
            <a href="#" class="hover:opacity-80"><i class="fas fa-cog"></i></a>
            <a href="#" class="hover:opacity-80"><i class="fas fa-sign-out-alt"></i></a>

        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 p-10 relative">

        <!-- HEADER KANAN -->
        <div class="absolute right-10 top-6 flex items-center gap-4">
           <a href="/create" 
   class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2 shadow">
    Pinjam Buku <i class="fas fa-plus text-xs"></i>
</a>

            <i class="fas fa-envelope text-gray-700 text-xl"></i>
            <i class="fas fa-bell text-gray-700 text-xl"></i>

            <div class="flex items-center gap-2">
                <div class="w-10 h-10 flex items-center justify-center bg-gray-300 text-gray-800 font-bold rounded-full">
                    FA
                </div>

                <span class="font-semibold">Fayza Azzahra</span>
                <i class="fas fa-chevron-down text-sm"></i>
            </div>
        </div>

        <!-- TITLE -->
        <h1 class="text-3xl font-bold mt-16">Data Pengembalian Buku</h1>
        <p class="text-sm text-gray-700">Hai Fayza, pastikan kamu mengembalikan buku tepat waktu, ya.</p>

        <!-- CARDS -->
        <div class="grid grid-cols-4 gap-6 mt-6">
            @foreach ([ ['20', 'Total'], ['2', 'Terlambat'], ['3', 'Sedang Dipinjam'], ['15', 'Telah Dikembalikan'] ] as $c)
            <div class="bg-[#B1321B] p-6 rounded-xl text-white shadow-lg text-center">
                <div class="text-4xl font-bold">{{ $c[0] }}</div>
                <div class="mt-1">{{ $c[1] }}</div>
            </div>
            @endforeach
        </div>

        <!-- FILTER -->
        <div class="flex items-center gap-3 mt-8">
            <input type="text" class="w-72 py-2 px-3 rounded-lg border" placeholder="Search">

            <select class="py-2 px-3 rounded-lg border w-40">
                <option>Kategori</option>
            </select>

            <select class="py-2 px-3 rounded-lg border w-40">
                <option>Status</option>
            </select>

            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow">Search</button>
        </div>

        <!-- TABLE -->
        <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-[#B1321B] text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID Peminjaman</th>
                        <th class="px-4 py-3 text-left">Judul Buku</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Opsi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach([
                        ['P-023456','Pemrograman Web dengan ...','Teknologi','15 April 2025','Selesai','green'],
                        ['P-032467','Algoritma dan Struktur Data','Informatika','19 Oktober 2025','Sedang Dipinjam','orange'],
                        ['P-098754','Psikologi Remaja Modern','Psikologi','3 Mei 2025','Selesai','green'],
                        ['P-086532','Dasar-Dasar Akuntansi','Ekonomi','17 Mei 2025','Selesai','green'],
                        ['P-076542','Manajemen Proyek TI','Manajemen','18 Juni 2025','Terlambat','red'],
                    ] as $row)

                    <tr class="odd:bg-gray-100">
                        <td class="px-4 py-2">{{ $row[0] }}</td>
                        <td class="px-4 py-2">{{ $row[1] }}</td>
                        <td class="px-4 py-2">{{ $row[2] }}</td>
                        <td class="px-4 py-2">{{ $row[3] }}</td>

                        <td class="px-4 py-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-{{ $row[5] }}-500"></span>
                            {{ $row[4] }}
                        </td>

                        <td class="px-4 py-2 text-center">
                            <button onclick="openDetail('{{ $row[0] }}','{{ $row[1] }}','{{ $row[2] }}','{{ $row[3] }}','{{ $row[4] }}')"
                                class="text-black hover:scale-110 transition">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>


<!-- DETAIL POPUP -->
<div id="detailPopup"
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white w-96 p-6 rounded-xl shadow-lg relative">

        <button onclick="closeDetail()"
                class="absolute right-4 top-3 text-gray-600 text-lg">✕</button>

        <h2 class="text-xl font-bold mb-4">Detail Peminjaman</h2>

        <div class="space-y-2 text-sm">
            <p><b>ID:</b> <span id="d_id"></span></p>
            <p><b>Judul:</b> <span id="d_judul"></span></p>
            <p><b>Kategori:</b> <span id="d_kategori"></span></p>
            <p><b>Tanggal:</b> <span id="d_tanggal"></span></p>
            <p><b>Status:</b> <span id="d_status"></span></p>
        </div>
    </div>
</div>

<script>
function openDetail(id, judul, kategori, tanggal, status) {
    document.getElementById('d_id').innerText = id;
    document.getElementById('d_judul').innerText = judul;
    document.getElementById('d_kategori').innerText = kategori;
    document.getElementById('d_tanggal').innerText = tanggal;
    document.getElementById('d_status').innerText = status;
    document.getElementById('detailPopup').classList.remove('hidden');
}
function closeDetail() {
    document.getElementById('detailPopup').classList.add('hidden');
}
</script>

</body>
</html>