<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Buku - Perpustakaan</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-yellow-200 to-yellow-300 min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-20 bg-[#B43C1E] text-white flex flex-col items-center py-4 space-y-6">
        <a href="/home" class="p-2 rounded-xl bg-white/20">
            <img src="{{ asset('icons/home.svg') }}" class="w-6">
        </a>
        <a href="/search">
            <img src="{{ asset('icons/search.svg') }}" class="w-6 opacity-80">
        </a>
        <a href="#">
            <img src="{{ asset('icons/category.svg') }}" class="w-6 opacity-80">
        </a>
        <a href="#">
            <img src="{{ asset('icons/book.svg') }}" class="w-6 opacity-80">
        </a>
        <a href="#">
            <img src="{{ asset('icons/setting.svg') }}" class="w-6 opacity-80">
        </a>
        <a href="#">
            <img src="{{ asset('icons/logout.svg') }}" class="w-6 opacity-80">
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">

        <!-- TOP NAV -->
        <div class="flex justify-end items-center space-x-6 mb-8">

            <button id="notifBtn" class="text-2xl">🔔</button>
            <button id="msgBtn" class="text-2xl">✉️</button>

            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/profile.png') }}" class="w-10 h-10 rounded-full">
                <span class="font-semibold">Fayza Azzahra ▾</span>
            </div>
        </div>

        <!-- SEARCH BAR -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center bg-white px-4 py-2 rounded-full w-1/3 shadow">
                <input type="text" class="w-full outline-none" placeholder="Search">
                <span class="text-xl">🔍</span>
            </div>
        </div>

        <!-- FILTER TAGS -->
        <div class="flex items-center flex-wrap gap-3 mb-4 px-2">
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Deep Learning ✕</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Android Programming ✕</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Operating System ✕</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Teknik Penulisan Ilmiah ✕</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">SQL for Data Analysis ✕</span>
        </div>

        <!-- KATEGORI -->
        <div class="flex items-center flex-wrap gap-3 px-2">
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">IT Infrastruktur</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Self Development</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Self Improvement</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Teknik Penulisan Ilmiah</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Bisnis Digital</span>
            <span class="px-3 py-1 bg-white rounded-full shadow text-sm">Sains & Matematika</span>
        </div>

        <div class="mt-8 grid grid-cols-3 gap-6">

            <!-- LEFT CONTENT -->
            <div class="col-span-2 space-y-8">

                <!-- TERAKHIR DIPINJAM -->
                <div class="bg-white rounded-2xl p-6 shadow">
                    <div class="flex justify-between">
                        <h3 class="font-bold text-lg">Terakhir Yang Dipinjam</h3>
                        <span class="text-sm text-gray-600 cursor-pointer">Lihat lebih banyak ➜</span>
                    </div>

                    <div class="flex gap-6 mt-4 overflow-x-auto">

                        @foreach(['SQL Server','Deep Learning','Aplikasi Web','Penelitian Kualitatif','Karya Ilmiah'] as $buku)
                        <div class="w-32">
                            <img src="{{ asset('images/book1.jpg') }}" class="w-full rounded shadow">
                            <p class="mt-2 text-sm font-semibold">{{ $buku }}</p>
                            <p class="text-xs text-gray-500">M.Pd | 2024</p>
                        </div>
                        @endforeach

                    </div>
                </div>

                <!-- REKOMENDASI -->
                <div class="bg-white rounded-2xl p-6 shadow">
                    <div class="flex justify-between">
                        <h3 class="font-bold text-lg">Rekomendasi Yang Mungkin Kamu Sukai</h3>
                        <span class="text-sm text-gray-600 cursor-pointer">Lihat lebih banyak ➜</span>
                    </div>

                    <div class="flex gap-6 mt-4 overflow-x-auto">

                        @foreach(['AI Revolution','Deep Learning','SQL 2000','Aplikasi Web','Menulis Ilmiah'] as $buku)
                        <div class="w-32">
                            <img src="{{ asset('images/book2.jpg') }}" class="w-full rounded shadow">
                            <p class="mt-2 text-sm font-semibold">{{ $buku }}</p>
                            <p class="text-xs text-gray-500">Skom., M.Kom | 2025</p>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>

            <!-- RIGHT FILTER -->
            <div class="bg-white rounded-2xl p-6 shadow h-fit">

                <h3 class="font-bold text-lg mb-4 flex items-center">
                    Filter <span class="ml-2 text-xl">⚿</span>
                </h3>

                <div class="grid grid-cols-2 gap-2 mb-6">
                    @for($i = 0; $i < 8; $i++)
                        <div class="h-6 bg-blue-200 rounded-full"></div>
                    @endfor
                </div>

                <h4 class="font-bold mb-2">Top Kategori Buku Kamu 📚</h4>
                <div class="flex flex-wrap gap-2 mb-5">
                    <span class="px-3 py-1 text-sm bg-red-600 text-white rounded-full">Teknologi</span>
                    <span class="px-3 py-1 text-sm bg-orange-500 text-white rounded-full">Pemrograman</span>
                    <span class="px-3 py-1 text-sm bg-red-700 text-white rounded-full">AI</span>
                    <span class="px-3 py-1 text-sm bg-yellow-700 text-white rounded-full">Data</span>
                </div>

                <h4 class="font-bold mb-2">Hasil Berdasarkan Minat Kamu 🧠</h4>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 text-sm bg-blue-200 rounded-full">Big Data Analytics</span>
                    <span class="px-3 py-1 text-sm bg-blue-200 rounded-full">Java for Beginners</span>
                    <span class="px-3 py-1 text-sm bg-blue-200 rounded-full">AI Revolution</span>
                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>