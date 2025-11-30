<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Buku - Perpustakaan</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        .sidebar-btn:hover {
            background: #ffffff40;
        }
        .tag-selected {
            background: #fff;
            border: 1px solid #ffbc4c;
            box-shadow: 0 3px 5px rgba(0,0,0,0.08);
        }
        .blue-pill {
            background: #d7edff;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#F8E79D] to-[#F4C86E] min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside id="sidebar"
       class="w-20 bg-[#C34722] text-white flex flex-col items-center py-6 shadow-lg relative">

    <div id="menuWrapper" class="relative flex flex-col items-center space-y-8 flex-1">

        <!-- Highlight -->
        <div id="highlight"
             class="absolute left-0 w-16 h-12 bg-white/30 rounded-xl transition-all duration-300 shadow-md -z-10"
             style="top: 0;">
        </div>

        <!-- HOME -->
        <button onclick="window.location.href='{{ url('/home') }}';"
            class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-house"></i>
        </button>

        <!-- SEARCH -->
        <button onclick="window.location.href='{{ url('/search') }}';"
            class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        <!-- TRANSAKSI -->
        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-file-lines"></i>
        </button>

        <!-- BUKU -->
        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-book"></i>
        </button>

        <!-- FAVORIT -->
        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-heart"></i>
        </button>

        <!-- SETTINGS -->
        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-gear"></i>
        </button>

    </div>

    <!-- LOGOUT PALING BAWAH -->
    <button onclick="window.location.href='{{ url('/welcome') }}';"
        class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100 mb-4 mt-auto">
        <i class="fa-solid fa-right-from-bracket"></i>
    </button>

</aside>

<script>
    const items = document.querySelectorAll(".menu-item");
    const highlight = document.getElementById("highlight");

    items.forEach((btn, index) => {
        btn.addEventListener("click", () => {
            highlight.style.top = (index * 80) + "px"; // 80px = space-y-8
        });
    });

    highlight.style.top = "0px";
</script>

    <!-- MAIN CONTENT -->
<main class="flex-1 p-8">

    <!-- TOP BAR -->
<div class="flex justify-end items-center space-x-6 mb-6 relative">


    <!-- NOTIFICATION BUTTON -->
        <button id="notifBtn" class="text-2xl hover:opacity-80 relative">
            🔔
        </button>

        <!-- MESSAGE BUTTON -->
        <button id="msgBtn" class="text-2xl hover:opacity-80 relative">
            ✉️
        </button>

        <div class="bg-blue-500 w-10 h-10 rounded-full text-white flex items-center justify-center font-bold">
            FA
        </div>

        <span class="font-semibold text-lg cursor-pointer">Fayza Azzahra ▾</span>
    </div>

<!-- POPUP NOTIF -->
<div id="notifPopup" class="absolute right-10 top-20 w-64 bg-white shadow-xl rounded-xl p-4 hidden z-50">
    <h3 class="font-semibold mb-3">Notifikasi</h3>

    <div class="space-y-3">

        <div class="p-3 bg-gray-100 rounded-lg">
            <p class="font-semibold">Buku Baru Tersedia</p>
            <p class="text-sm text-gray-600">“Clean Architecture” baru ditambahkan.</p>
        </div>

        <div class="p-3 bg-gray-100 rounded-lg">
            <p class="font-semibold">Peringatan</p>
            <p class="text-sm text-gray-600">Segera kembalikan buku “Machine Learning”.</p>
        </div>

    </div>
</div>

<!-- POPUP PESAN ADMIN -->
<div id="msgPopup" class="absolute right-10 top-20 w-72 bg-white shadow-xl rounded-xl p-4 hidden z-50">

    <h3 class="font-semibold mb-3">Pesan Admin</h3>

    <div class="space-y-4">

        <!-- PESAN -->
        <div class="message-item flex items-start gap-3 bg-gray-100 p-3 rounded-xl relative">

            <!-- ICON PROFIL -->
            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-user text-gray-700"></i>
            </div>

            <!-- ISI PESAN -->
            <div>
                <p class="font-semibold text-[15px]">Admin Perpustakaan</p>
                <p class="text-sm text-gray-700">
                    Halo Fayza, peminjaman buku <b>Clean Code</b> kamu sudah disetujui. Silakan ambil di loket perpustakaan.
                </p>

                <div class="flex gap-4 mt-2">
                    <button class="reply-btn text-blue-600 text-sm">Balas</button>
                    <button class="delete-btn text-red-600 text-sm">Hapus</button>
                </div>

                <!-- INPUT BALAS -->
                <div class="reply-box hidden mt-2">
                    <input type="text" class="w-full p-2 border rounded-lg text-sm" placeholder="Tulis balasan...">
                    <button class="send-reply mt-1 bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">Kirim</button>
                </div>
            </div>

        </div>
    </div>
</div>


       <div class="flex justify-center mb-4 relative w-2/3 mx-auto">
    <input type="text" 
           id="searchInput" 
           class="w-full pl-12 pr-4 py-3 rounded-full shadow-lg border border-yellow-300 outline-none" 
           placeholder="Cari buku...">
    
    <!-- ICON SEARCH -->
    <img src="{{ asset('icons/search.svg') }}" 
         class="w-5 absolute left-4 top-1/2 -translate-y-1/2 opacity-80">
    
    <!-- Dropdown Hasil Search -->
    <div id="searchResults" class="absolute top-full left-0 w-full mt-1 bg-white shadow-lg rounded-lg max-h-60 overflow-y-auto hidden z-50">
        <!-- Hasil search muncul di sini -->
    </div>
</div>

        <!-- TOP KATEGORI (NEW) -->
        <div class="px-3 mt-3">
            <h4 class="font-semibold text-gray-700 mb-2">Top Kategori</h4>
            <div class="flex gap-3 flex-wrap">
                <span class="px-4 py-1 rounded-full bg-white shadow text-sm">Teknologi Informasi</span>
                <span class="px-4 py-1 rounded-full bg-white shadow text-sm">AI & Machine Learning</span>
                <span class="px-4 py-1 rounded-full bg-white shadow text-sm">Statistika</span>
                <span class="px-4 py-1 rounded-full bg-white shadow text-sm">Manajemen</span>
                <span class="px-4 py-1 rounded-full bg-white shadow text-sm">Psikologi</span>
            </div>
        </div>

        <!-- HASIL MINAT (NEW) -->
        <div class="px-3 mt-6">
            <h4 class="font-semibold text-gray-700 mb-2">Hasil Minat Bacaan Kamu</h4>
            <div class="flex gap-4 overflow-x-auto pb-2">

                @foreach([
                    ['AI Dasar','images/ai1.jpg'],
                    ['Cloud Intro','images/cloud.jpg'],
                    ['UI/UX Modern','images/uiux.jpg'],
                    ['Algoritma','images/algoritma.jpg'],
                ] as $minat)

                <div class="min-w-[130px]">
                    <img src="{{ asset($minat[1]) }}" class="w-full rounded-xl shadow-md">
                    <p class="mt-2 font-semibold text-sm">{{ $minat[0] }}</p>
                    <p class="text-xs text-gray-500">Minat Tinggi</p>
                </div>

                @endforeach

            </div>
        </div>

        <!-- RIWAYAT PENCARIAN -->
        <div class="flex items-center justify-between px-3 mt-8">
            <h4 class="font-semibold text-gray-700">Riwayat Pencarian</h4>
            <button onclick="clearAllHistory()" class="text-red-600 text-sm">Hapus Semua</button>
        </div>

        <div id="historyWrapper" class="flex flex-wrap gap-3 mb-4 px-3 mt-1"></div>

        <!-- GRID -->
        <div class="mt-8 grid grid-cols-3 gap-8">

            <!-- LEFT CONTENT -->
            <div class="col-span-2 space-y-10">

                <!-- TERAKHIR DIPINJAM -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-yellow-200">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-lg">Terakhir Yang Dipinjam</h3>
                        <span class="text-sm text-gray-600 cursor-pointer">Lihat Lebih Banyak ↗</span>
                    </div>

                    <div class="flex gap-6 mt-6 overflow-x-auto">
                        @foreach(['Menulis Ilmiah','Deep Learning','SQL 2000','Penelitian Kualitatif','Pemrograman Web'] as $buku)
                        <div class="w-32">
                            <img src="{{ asset('images/book1.jpg') }}" class="w-full rounded-lg shadow-md">
                            <p class="mt-2 text-sm font-semibold">{{ $buku }}</p>
                            <p class="text-xs text-gray-500">M.Pd | 2024</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- REKOMENDASI -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-yellow-200">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-lg">Rekomendasi Yang Mungkin Kamu Sukai</h3>
                        <span class="text-sm text-gray-600 cursor-pointer">Lihat Lebih Banyak ↗</span>
                    </div>

                    <div class="flex gap-6 mt-6 overflow-x-auto">
                        @foreach(['AI Revolution','Java Dasar','SQL 2000','Aplikasi Web','Menulis Ilmiah'] as $buku)
                        <div class="w-32">
                            <img src="{{ asset('images/book2.jpg') }}" class="w-full rounded-lg shadow-md">
                            <p class="mt-2 text-sm font-semibold">{{ $buku }}</p>
                            <p class="text-xs text-gray-500">Dr. Skom, M.Kom</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- RIGHT FILTER -->
            <div class="bg-white rounded-2xl p-6 shadow-md h-fit border border-yellow-200">

                <h3 class="font-bold text-lg mb-4">Filter Buku</h3>

                <!-- Jenis Buku -->
                <h4 class="font-semibold mb-2">Jenis Buku</h4>
                <div class="flex flex-wrap gap-2 mb-4">
                    <label class="blue-pill px-3 py-1 rounded-full text-sm cursor-pointer">Fiksi</label>
                    <label class="blue-pill px-3 py-1 rounded-full text-sm cursor-pointer">Non-Fiksi</label>
                    <label class="blue-pill px-3 py-1 rounded-full text-sm cursor-pointer">Referensi</label>
                </div>

                <!-- Bahasa -->
                <h4 class="font-semibold mb-2">Bahasa</h4>
                <div class="flex flex-wrap gap-2 mb-4">
                    <label class="blue-pill px-3 py-1 rounded-full text-sm cursor-pointer">Indonesia</label>
                    <label class="blue-pill px-3 py-1 rounded-full text-sm cursor-pointer">English</label>
                </div>

                <!-- Tahun Terbit -->
<h4 class="font-semibold mb-3">Tahun Terbit</h4>
<div class="flex items-center gap-4 mb-4">
    <span id="yearMin" class="text-sm text-gray-600">1990</span>
    <input type="range" id="yearRange" min="1990" max="2025" value="2025" class="flex-1">
    <span id="yearMax" class="text-sm text-gray-600">2025</span>
</div>

        </div>

    </main>

</div>

<!-- JAVASCRIPT RIWAYAT -->
<script>
    let searchHistory = ["Deep Learning","Android Programming","Operating System","Penulisan Ilmiah","SQL Data"];

    function renderHistory() {
        const wrapper = document.getElementById("historyWrapper");
        wrapper.innerHTML = "";

        searchHistory.forEach((item, index) => {
            wrapper.innerHTML += `
                <span class="px-4 py-1 rounded-full tag-selected text-sm flex items-center gap-1">
                    ${item}
                    <button onclick="deleteHistory(${index})" class="text-red-600 font-bold ml-1">✕</button>
                </span>
            `;
        });
    }

    function deleteHistory(i) {
        searchHistory.splice(i, 1);
        renderHistory();
    }

    function clearAllHistory() {
        searchHistory = [];
        renderHistory();
    }

    renderHistory();
</script>

<script>
    const notifBtn = document.getElementById("notifBtn");
    const msgBtn = document.getElementById("msgBtn");

    const notifPopup = document.getElementById("notifPopup");
    const msgPopup = document.getElementById("msgPopup");

    notifBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        notifPopup.classList.toggle("hidden");
        msgPopup.classList.add("hidden");
    });

    msgBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        msgPopup.classList.toggle("hidden");
        notifPopup.classList.add("hidden");
    });

    // Klik Luar → Tutup
    document.addEventListener("click", () => {
        notifPopup.classList.add("hidden");
        msgPopup.classList.add("hidden");
    });
</script>

<script>
    // Delete pesan
    document.querySelectorAll(".delete-btn").forEach(b => {
        b.addEventListener("click", function () {
            this.closest(".message-item").remove();
        });
    });

    // Toggle balas
    document.querySelectorAll(".reply-btn").forEach(b => {
        b.addEventListener("click", function () {
            const box = this.closest(".message-item").querySelector(".reply-box");
            box.classList.toggle("hidden");
        });
    });

    // Kirim
    document.querySelectorAll(".send-reply").forEach(b => {
        b.addEventListener("click", function () {
            const input = this.previousElementSibling;
            if (input.value.trim() !== "") {
                alert("Balasan terkirim:\n" + input.value);
                input.value = "";
            }
        });
    });
</script>

<script>
    const books = [
    "Deep Learning",
    "AI Dasar",
    "Cloud Intro",
    "UI/UX Modern",
    "Algoritma",
    "SQL 2000",
    "Pemrograman Web",
    "Menulis Ilmiah"
];

const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");

searchInput.addEventListener("input", () => {
    const query = searchInput.value.toLowerCase();
    searchResults.innerHTML = "";

    if(query === "") {
        searchResults.classList.add("hidden");
        return;
    }

    const filteredBooks = books.filter(book => book.toLowerCase().includes(query));

    if(filteredBooks.length === 0) {
        searchResults.innerHTML = `<p class="p-3 text-gray-500">Buku tidak ditemukan</p>`;
    } else {
        filteredBooks.forEach(book => {
            const div = document.createElement("div");
            div.textContent = book;
            div.className = "p-3 cursor-pointer hover:bg-yellow-100 rounded-lg";
            div.addEventListener("click", () => {
                searchInput.value = book;
                searchResults.classList.add("hidden");
            });
            searchResults.appendChild(div);
        });
    }

    searchResults.classList.remove("hidden");
});

// Klik luar → tutup dropdown
document.addEventListener("click", (e) => {
    if(!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
        searchResults.classList.add("hidden");
    }
});
</script>

<script>
    const yearRange = document.getElementById("yearRange");
const yearMin = document.getElementById("yearMin");
const yearMax = document.getElementById("yearMax");

// Update label saat slider digeser
yearRange.addEventListener("input", () => {
    yearMax.textContent = yearRange.value;
});
</script>

</body>
</html>