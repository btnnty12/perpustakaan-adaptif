<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Perpustakaan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/home.css">

</head>

<body class="bg-gradient-to-b from-yellow-200 to-yellow-300 min-h-screen flex">

<aside id="sidebar"
       class="w-20 bg-[#C34722] text-white flex flex-col items-center py-6 shadow-lg relative">

    <div id="menuWrapper" class="relative flex flex-col items-center space-y-8 flex-1">

        <!-- Highlight PUTIH -->
        <div id="highlight"
             class="absolute left-0 w-16 h-12 bg-white/30 rounded-xl transition-all duration-300 shadow-md -z-10"
             style="top: 0;">
        </div>

        <!-- Icons -->
        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-house"></i>
        </button>

        <button 
    onclick="window.location.href='/search';"
    class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
    <i class="fa-solid fa-magnifying-glass"></i>
</button>

        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-file-lines"></i>
        </button>

        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-book"></i>
        </button>

        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-heart"></i>
        </button>

        <button class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-gear"></i>
        </button>
    </div>

    <!-- LOGOUT PALING BAWAH -->
    <button 
        onclick="window.location.href='/welcome';"
        class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100 mb-4 mt-auto">
        <i class="fa-solid fa-right-from-bracket"></i>
    </button>

</aside>

<!-- MENU HIGHLIGHT SCRIPT -->
<script>
    const items = document.querySelectorAll(".menu-item");
    const highlight = document.getElementById("highlight");

    items.forEach((btn, index) => {
        btn.addEventListener("click", () => {
            highlight.style.top = (index * 80) + "px";
        });
    });

    highlight.style.top = "0px";
</script>

<!-- Font Awesome -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

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


    <!-- ============================== -->
    <!--       POPUP NOTIF & PESAN      -->
    <!-- ============================== -->

    <!-- POPUP NOTIFIKASI -->
    <div id="notifPopup"
         class="hidden absolute top-20 right-40 w-72 bg-white shadow-xl rounded-2xl p-4 z-50">
        <h3 class="font-bold mb-3 text-lg">Notifikasi</h3>
        <ul class="space-y-3 text-sm">
            <li class="p-3 bg-gray-100 rounded-xl">📘 Buku "Clean Code" sudah kembali</li>
            <li class="p-3 bg-gray-100 rounded-xl">⏳ Peminjaman kamu tinggal 3 hari</li>
            <li class="p-3 bg-gray-100 rounded-xl">✨ Ada rekomendasi buku baru untukmu</li>
        </ul>
    </div>

    <!-- POPUP PESAN -->
    <!-- POPUP PESAN KHUSUS ADMIN -->
<div id="msgPopup"
     class="hidden absolute top-12 right-20 w-96 bg-white shadow-xl rounded-2xl p-5 z-50">

    <h3 class="font-bold mb-4 text-lg">Pesan dari Admin</h3>

    <div id="adminMessages" class="space-y-4 max-h-80 overflow-y-auto pr-1">

        <!-- PESAN ADMIN -->
        <div class="message-item bg-gray-100 p-4 rounded-xl">
            <div class="flex items-start space-x-3">

                <!-- ICON ORANG -->
                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="flex-1">
                    <div class="font-semibold text-sm">Admin Perpustakaan</div>

                    <div class="text-sm text-gray-600 mt-1">
                        Halo Fayza, peminjaman buku <b>Clean Code</b> kamu sudah disetujui.
                        Silakan ambil di loket perpustakaan.
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex gap-3 mt-3">
                        <button class="reply-btn text-xs text-blue-600 hover:underline">Balas</button>
                        <button class="delete-btn text-xs text-red-600 hover:underline">Hapus</button>
                    </div>

                    <!-- INPUT BALAS -->
                    <div class="reply-box hidden mt-3">
                        <input type="text"
                               class="w-full border rounded-lg px-3 py-1 text-sm"
                               placeholder="Tulis balasan...">
                        <button class="send-reply mt-2 bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">
                            Kirim
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


    <!-- BANNER -->
    <div class="w-full bg-[#C4431E] rounded-3xl text-white p-10 flex justify-between shadow-xl relative overflow-hidden">
        <div class="w-2/3">
            <h1 class="text-4xl font-bold">Hi, Fayza</h1>
            <p class="text-xl mt-2 mb-6">ada koleksi buku baru yang bisa kamu jelajahi hari ini!</p>

            <button class="bg-white text-[#C4431E] px-6 py-2 rounded-full font-semibold shadow">
                Jelajahi Sekarang!
            </button>
        </div>

        <img src="https://i.ibb.co/4N95fxt/books.png" class="w-48 absolute right-12 bottom-6">
    </div>

    <!-- GRID 3 KOLOM (REVISI LAYOUT) -->
    <div class="grid grid-cols-3 gap-8 mt-10 items-stretch">

    
        <!-- REKOMENDASI (kiri full) -->
<div class="col-span-2">
    <div class="bg-white p-6 rounded-2xl shadow-lg h-full flex flex-col">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Rekomendasi Untuk Kamu</h2>
                    <a href="#" class="text-sm font-semibold text-gray-600 hover:text-black flex items-center">
                        Lihat Lebih Banyak ►
                    </a>
                </div>

                <div class="flex-1 overflow-y-auto pr-2 mt-4 relative" id="scrollBox">
                    <div id="fadeBottom"
     class="pointer-events-none absolute bottom-0 left-0 right-0 h-12 
            bg-gradient-to-t from-white to-transparent">
</div>
                    <div class="grid grid-cols-5 gap-x-6 gap-y-10">

                        <!-- Semua item buku kamu tetap sama -->
                        <!-- (tidak saya ubah satupun) -->
                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/hMncDr2/ml.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Machine<br>Learning</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/9qsB1xB/ai.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Artificial<br>Intelligence</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/9nBNR4w/cyber.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Cyber<br>Security</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/zmd5jJg/math.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Kalkulus<br>Book</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/XFZwcNm/ux.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">UX Design<br>Thinking</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <!-- BARIS 2 -->
                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/rGdm32f/web.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Pemrograman<br>Aplikasi Web</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/xDLMp7R/java.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Java<br>Book</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/S6Wbn5p/python.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Python<br>Book</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/PYY8spf/docker.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Docker<br>Book</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                        <div class="flex flex-col items-center">
                            <img src="https://i.ibb.co/Kxqs6bQ/statistika.jpg" class="w-36 h-48 object-cover rounded-xl shadow">
                            <p class="font-semibold text-center mt-2">Statistika<br>Buku</p>
                            <button class="mt-1 text-xl font-bold">＋</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ========================= -->
        <!-- AKTIVITAS (kanan — atas) -->
        <!-- ========================= -->
       <!-- ========================= -->
<!-- KOLOM KANAN -->
<!-- ========================= -->
<div class="col-span-1 flex flex-col gap-8">

    <!-- AKTIVITAS -->
    <div class="bg-[#B54C2B] text-white p-8 rounded-3xl shadow-xl w-full">
        <h2 class="text-2xl font-bold text-center mb-8">Aktivitas Pengguna</h2>

        <div class="grid grid-cols-2 gap-10 place-items-center">
            <div class="flex flex-col items-center space-y-3">
                <div class="w-24 h-24 border-2 border-white rounded-2xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 4v16a1 1 0 001 1h12a1 1 0 001-1V4m-7 9l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                </div>
                <p class="text-lg font-medium text-center">1 Buku sedang dipinjam</p>
            </div>

            <div class="flex flex-col items-center space-y-3">
                <div class="w-24 h-24 border-2 border-white rounded-2xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-lg font-medium text-center">3 Hari lagi pengembalian</p>
            </div>
        </div>

        <div class="bg-white text-black text-center mt-8 py-3 px-5 rounded-full font-semibold shadow-sm text-[16px] leading-tight">
            5 Buku yang telah dibaca bulan ini <br>
            Genre buku favoritmu <span class="font-bold">Teknologi</span>
        </div>
    </div>

    <!-- RIWAYAT -->
    <div class="bg-white p-7 rounded-3xl shadow-xl w-full">
       <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
            <span class="px-5 py-2 bg-[#DDA08A] rounded-full font-semibold text-[15px] shadow-sm">
                Riwayat Peminjaman
            </span>

            <div class="flex items-center gap-3">
                <input id="searchInput" type="text" placeholder="Cari buku..."
                <input id="searchInput" type="text" placeholder="Cari buku..."
       class="border rounded-full px-3 py-1.5 text-sm w-32 focus:ring-2 focus:ring-[#DDA08A]">

<select id="filterSelect"
        class="border rounded-full px-3 py-1.5 text-sm w-32 focus:ring-2 focus:ring-[#DDA08A]">
                    <option value="all">Semua</option>
                    <option value="returned">Dikembalikan</option>
                    <option value="not-returned">Belum Dikembalikan</option>
                </select>
            </div>
        </div>

        <div id="loanList" class="space-y-6 text-[17px] leading-relaxed font-medium pl-3"></div>
    </div>

</div>

    <!-- SCRIPT RIWAYAT -->
    <script>
        const scrollBox = document.getElementById("scrollBox");
const fadeBottom = document.getElementById("fadeBottom");

scrollBox.addEventListener("scroll", () => {
    const atBottom = scrollBox.scrollHeight - scrollBox.scrollTop <= scrollBox.clientHeight + 2;

    fadeBottom.style.opacity = atBottom ? "0" : "1";
});
        const loans = [
            { title: "Clean Code, Robert C. Martin", status: "returned", date: "10 Okt 2025" },
            { title: "Machine Learning, Andrew Ng", status: "returned", date: "05 Sep 2025" },
            { title: "Sistem Basis Data, Silberschatz", status: "not-returned", date: null }
        ];

        const list = document.getElementById("loanList");
        const searchInput = document.getElementById("searchInput");
        const filterSelect = document.getElementById("filterSelect");

        function renderList() {
            const keyword = searchInput.value.toLowerCase();
            const filter = filterSelect.value;

            list.innerHTML = "";

            loans
                .filter(item =>
                    item.title.toLowerCase().includes(keyword) &&
                    (filter === "all" ||
                        (filter === "returned" && item.status === "returned") ||
                        (filter === "not-returned" && item.status === "not-returned"))
                )
                .forEach((item, index) => {
                    const div = document.createElement("div");
                    div.innerHTML = `
                        <div>
                            <span class="font-bold">${index + 1}. ${item.title}</span><br>
                            ${item.status === "returned"
                        ? `<span>Dikembalikan: ${item.date}</span>`
                        : `<span class="text-red-600 font-semibold">Belum dikembalikan</span>`}
                        </div>
                    `;
                    list.appendChild(div);
                });
        }

        searchInput.addEventListener("input", renderList);
        filterSelect.addEventListener("change", renderList);

        renderList();
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

    // Klik luar menutup semua popup
    document.addEventListener("click", () => {
        notifPopup.classList.add("hidden");
        msgPopup.classList.add("hidden");
    });
</script>
<script>
    // HAPUS PESAN
    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            this.closest(".message-item").remove();
        });
    });

    // TAMPILKAN INPUT BALAS
    document.querySelectorAll(".reply-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const box = this.closest(".message-item").querySelector(".reply-box");
            box.classList.toggle("hidden");
        });
    });

    // KIRIM BALASAN
    document.querySelectorAll(".send-reply").forEach(btn => {
        btn.addEventListener("click", function () {
            const input = this.previousElementSibling;
            const value = input.value.trim();

            if (value !== "") {
                alert("Balasan terkirim:\n" + value);
                input.value = "";
            }
        });
    });
</script>

</main>

</body>
</html>