<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Perpustakaan</title>

    <!-- TAILWIND ONLINE -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body class="bg-gradient-to-b from-yellow-200 to-yellow-300 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-20 bg-[#B43C1E] text-white flex flex-col items-center py-5 space-y-8">

        <!-- Menu Icon -->
        <button class="text-2xl">☰</button>

        <!-- Icons -->
        <a class="sidebar-icon active">🏠</a>
        <a href="{{ route('search') }}" class="text-xl">🔍</a>
        <a class="sidebar-icon">📄</a>
        <a class="sidebar-icon">📚</a>
        <a class="sidebar-icon">⚙️</a>
        <a class="sidebar-icon">⤴</a>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6">

        <!-- TOP NAV -->
        <div class="flex justify-end items-center space-x-4 mb-6">
            
            <button id="btnNotif" class="text-xl cursor-pointer">🔔</button>
            <button id="btnPesan" class="text-xl cursor-pointer">✉️</button>

            <div class="bg-blue-500 w-10 h-10 rounded-full text-white flex items-center justify-center">
                FA
            </div>

            <span class="font-semibold">Fayza Azzahra ▾</span>
        </div>

        <!-- BANNER -->
        <div class="w-full bg-[#C4431E] rounded-3xl text-white p-8 flex justify-between relative shadow-lg">

            <div class="w-2/3">
                <h1 class="text-3xl font-bold mb-2">Hi, Fayza</h1>
                <p class="text-lg mb-4">ada koleksi buku baru yang bisa kamu jelajahi hari ini!</p>

                <button class="bg-white text-[#C4431E] px-6 py-2 rounded-full font-semibold">
                    Jelajahi Sekarang!
                </button>
            </div>

            <img src="{{ asset('images/banner-books.png') }}" class="w-48 absolute right-10 bottom-5">
        </div>

        <!-- CONTENT GRID -->
        <div class="grid grid-cols-3 gap-6 mt-8">

            <!-- REKOMENDASI -->
            <div class="col-span-2 bg-white p-6 rounded-2xl shadow-md">
                <h2 class="text-xl font-bold">Rekomendasi Untuk Kamu</h2>

                <div class="flex gap-4 mt-4 overflow-x-auto">

                    <!-- TEMPLATE BUKU -->
                    <div class="book-card">
                        <img src="{{ asset('images/Machine Learning.jpeg') }}">
                        <p class="book-title">Machine Learning</p>
                    </div>

                    <div class="book-card">
                        <img src="{{ asset('images/book2.jpg') }}">
                        <p class="book-title">Artificial Intelligence</p>
                    </div>

                    <div class="book-card">
                        <img src="{{ asset('images/book3.jpg') }}">
                        <p class="book-title">Cyber Security</p>
                    </div>

                    <div class="book-card">
                        <img src="{{ asset('images/book4.jpg') }}">
                        <p class="book-title">Kalkulus Book</p>
                    </div>

                    <div class="book-card">
                        <img src="{{ asset('images/book5.jpg') }}">
                        <p class="book-title">UX Design Thinking</p>
                    </div>

                </div>
            </div>

            <!-- AKTIVITAS -->
            <div class="bg-[#C4431E] text-white p-6 rounded-2xl shadow-lg">
                <h2 class="text-lg font-bold text-center mb-4">Aktivitas Pengguna</h2>

                <div class="flex justify-around text-center">
                    <div>
                        <div class="text-4xl mb-1">☑️</div>
                        <p>1 Buku sedang<br>dipinjam</p>
                    </div>

                    <div>
                        <div class="text-4xl mb-1">⭐</div>
                        <p>3 Hari lagi<br>pengembalian</p>
                    </div>
                </div>

                <div class="bg-white text-black mt-5 py-2 px-3 rounded-xl text-center text-sm font-semibold">
                    5 Buku yang telah di baca bulan ini<br>
                    Genre buku favoritmu Teknologi
                </div>
            </div>

        </div>

        <!-- RIWAYAT -->
        <div class="bg-white p-6 rounded-2xl shadow-md mt-6 w-[48%]">

            <div class="bg-[#E5A07C] inline-block px-4 py-2 rounded-full font-semibold">
                Riwayat Peminjaman  
            </div>

            <ol class="mt-4 text-sm leading-6">
                <li><strong>Clean Code</strong>, Robert C. Martin<br>Dikembalikan: 10 Okt 2025</li>

                <li class="mt-3"><strong>Machine Learning</strong>, Andrew Ng<br>Dikembalikan: 05 Sep 2025</li>

                <li class="mt-3">
                    <strong>Sistem Basis Data</strong>, Silberschatz<br>
                    <span class="text-red-500 font-bold">Belum dikembalikan</span>
                </li>
            </ol>

        </div>

    </main>


    <!-- ===================================================== -->
    <!--            NOTIFICATION PANEL - BLUE                  -->
    <!-- ===================================================== -->
    <div id="popupNotif" class="hidden fixed inset-0 bg-black/40 flex justify-center pt-20 z-50">
        <div class="w-[450px] bg-white rounded-2xl shadow-xl p-5">

            <div class="flex justify-between items-center mb-3">
                <h2 class="font-bold text-lg">Notifikasi</h2>
                <button id="closeNotif" class="text-2xl">✖</button>
            </div>

            <div class="space-y-3">

                <div class="bg-blue-200 rounded-xl p-3 flex items-start gap-3">
                    <div class="text-3xl">📘</div>
                    <p>Peminjaman buku <b>Clean Code</b> berhasil. Kembalikan sebelum 10 Oktober 2025.</p>
                </div>

                <div class="bg-blue-200 rounded-xl p-3 flex items-start gap-3">
                    <div class="text-3xl">⏳</div>
                    <p>Buku <b>Machine Learning</b> harus dikembalikan dalam 3 hari.</p>
                </div>

                <div class="bg-blue-200 rounded-xl p-3 flex items-start gap-3">
                    <div class="text-3xl">⚠️</div>
                    <p>Buku <b>Sistem Basis Data</b> terlambat 2 hari.</p>
                </div>

                <div class="bg-blue-200 rounded-xl p-3 flex items-start gap-3">
                    <div class="text-3xl">📚</div>
                    <p>Buku baru <b>AI for Everyone</b> sudah tersedia di rak Teknologi.</p>
                </div>

            </div>
        </div>
    </div>


    <!-- ===================================================== -->
    <!--                 MESSAGE PANEL - GREY                  -->
    <!-- ===================================================== -->
    <div id="popupPesan" class="hidden fixed inset-0 bg-black/40 flex justify-center pt-20 z-50">
        <div class="w-[480px] bg-white rounded-2xl shadow-xl p-5">

            <div class="flex justify-between items-center mb-3">
                <h2 class="font-bold text-lg">Pesan Dari Perpus</h2>
                <button id="closePesan" class="text-2xl">✖</button>
            </div>

            <div class="space-y-3">

                <div class="bg-gray-200 rounded-xl p-3 flex gap-3">
                    <div class="text-3xl">👤</div>
                    <div class="flex-1">
                        <b>Perpus</b>
                        <p>Halo Fayza, peminjaman buku Clean Code kamu sudah disetujui.</p>
                        <div class="flex justify-end text-xs gap-4 mt-1">
                            <a class="text-red-600 cursor-pointer">Hapus</a>
                            <a class="text-blue-600 cursor-pointer">Balas</a>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-200 rounded-xl p-3 flex gap-3">
                    <div class="text-3xl">👤</div>
                    <div class="flex-1">
                        <b>Perpus</b>
                        <p>Jangan lupa buku Machine Learning dikembalikan sebelum 10 Oktober 2025.</p>
                        <div class="flex justify-end text-xs gap-4 mt-1">
                            <a class="text-red-600 cursor-pointer">Hapus</a>
                            <a class="text-blue-600 cursor-pointer">Balas</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>




    <!-- ===================================================== -->
    <!--                   JAVASCRIPT POPUP                    -->
    <!-- ===================================================== -->
    <script>
        const btnNotif = document.getElementById("btnNotif");
        const btnPesan = document.getElementById("btnPesan");
        
        const popupNotif = document.getElementById("popupNotif");
        const popupPesan = document.getElementById("popupPesan");

        const closeNotif = document.getElementById("closeNotif");
        const closePesan = document.getElementById("closePesan");

        // Open Notif
        btnNotif.onclick = () => {
            popupNotif.classList.remove("hidden");
            popupPesan.classList.add("hidden");
        };

        // Open Pesan
        btnPesan.onclick = () => {
            popupPesan.classList.remove("hidden");
            popupNotif.classList.add("hidden");
        };

        // Close buttons
        closeNotif.onclick = () => popupNotif.classList.add("hidden");
        closePesan.onclick = () => popupPesan.classList.add("hidden");

        // Close when clicking background
        popupNotif.onclick = e => { if (e.target === popupNotif) popupNotif.classList.add("hidden"); };
        popupPesan.onclick = e => { if (e.target === popupPesan) popupPesan.classList.add("hidden"); };
    </script>

</body>
</html>