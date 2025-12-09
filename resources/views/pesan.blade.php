<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-gradient-to-br from-yellow-200 to-yellow-300 min-h-screen flex">

<!-- SIDEBAR -->
<aside id="sidebar" class="w-20 bg-[#C34722] text-white flex flex-col items-center py-6 shadow-lg relative">
    <div id="menuWrapper" class="relative flex flex-col items-center space-y-8 flex-1">
        <div id="highlight" class="absolute left-0 w-16 h-12 bg-white/30 rounded-xl transition-all duration-300 shadow-md -z-10" style="top: 0;"></div>
        <button onclick="window.location.href='/home';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-house"></i></button>
        <button onclick="window.location.href='/search';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-magnifying-glass"></i></button>
        <button onclick="window.location.href='/pengembalian-buku';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-file-lines"></i></button>
        <button onclick="window.location.href='/pinjaman';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-book"></i></button>
        <button onclick="window.location.href='/favorit';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-heart"></i></button>
        <button onclick="window.location.href='/pengaturan';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-gear"></i></button>
        <button onclick="window.location.href='{{ url('/logout') }}'" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100 mb-4 mt-auto"><i class="fa-solid fa-right-from-bracket"></i></button>
    </div>
</aside>

<!-- MAIN CONTENT -->
<div class="flex-1 p-10">
    <h1 class="text-4xl font-bold mb-6 text-[#A63A2D]">Pesan</h1>
    <p class="text-gray-700 mb-8">Hai {{ $user['nama'] ?? 'Pengguna' }}, lihat pesan dari perpustakaan di sini.</p>

    <!-- MESSAGES LIST -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="space-y-4">
            <!-- Sample Message -->
            <div class="border-b pb-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-[#B1321B] rounded-full flex items-center justify-center text-white font-bold">
                        P
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold">Perpustakaan</h3>
                            <span class="text-sm text-gray-500">2 hari yang lalu</span>
                        </div>
                        <p class="text-gray-700">Buku yang Anda pinjam akan segera dikembalikan. Terima kasih!</p>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div class="text-center py-12 text-gray-500">
                <i class="fas fa-inbox text-6xl mb-4 opacity-50"></i>
                <p>Tidak ada pesan baru</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
