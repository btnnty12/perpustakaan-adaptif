<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Dashboard - Perpustakaan</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style> 
    /* small customizations to match the feel */
    .sidebar-bg { background: #8a3b2b; }            /* coklat sidebar */
    .page-gradient { background: linear-gradient(180deg,#f7d77a 0%, #f6d99f 30%, #fff7ec 100%); }
    .banner-deep { background: #9b3d29; }           /* deep red/brown banner */
    .card-soft { background: rgba(255,255,255,0.92); }
    .stat-radius { border-radius: 14px; }
    .stat-num { font-size: 42px; font-weight: 800; }
    .activity-item { background: #f1d6a2; }        /* pale yellow item */
    /* small scrollbar for activity list */
    .scrollbar-thin::-webkit-scrollbar { height: 8px; width: 8px; }
    .scrollbar-thin::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius: 999px; }

.sidebar {
    width: 80px;
    background-color: #A24731; /* warna merah sidebar */
    height: 100vh;
    padding-top: 40px;
    position: relative;
}

/* Container menu icon */
.menu-item {
    position: relative;
    margin: 25px 0;
    display: flex;
    justify-content: center;
}

#indicator {
    position: absolute;
    left: 0px;
    top: 123px;              /* naik-turunkan dari sini */

    width: 75px;             /* ukuran indikator */
    height: 38px;            /* tinggi indikator */

    background-color: #F7DE68;
    border-radius: 0 20px 20px 0;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.35);   /* bayangan */
    transition: 0.3s ease-in-out;
    z-index: 1;
}

/* Icon */
.menu-item img {
    width: 26px;
    height: 26px;
    z-index: 2; /* supaya icon di atas indikator */
}

  </style>
</head>
<body class="page-gradient min-h-screen text-gray-800">

  <div class="flex">

<!-- SIDEBAR -->
<div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6 relative">

    <!-- INDIKATOR -->
    <div id="indicator"></div>

    <!-- MENU ATAS -->
  <div class="flex flex-col items-center space-y-20 pt-20">

    <div class="menu-item" data-index="0">
        <img src="{{ asset('icons/home.png') }}" class="w-7">
    </div>

    <div class="menu-item" data-index="1">
        <img src="{{ asset('icons/data-anggota.png') }}" class="w-7">
    </div>

    <div class="menu-item" data-index="2">
        <img src="{{ asset('icons/kelola-buku.png') }}" class="w-7">
    </div>

    <div class="menu-item" data-index="3">
        <img src="{{ asset('icons/laporan-peminjaman.png') }}" class="w-7">
    </div>

    <div class="menu-item" data-index="4">
        <img src="{{ asset('icons/user.png') }}" class="w-7">
    </div>

    <div class="menu-item" data-index="4">
        <img src="{{ asset('icons/setting.png') }}" class="w-7">
    </div>

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

      <!-- BANNER -->
      <section class="px-8 pt-8 pb-6">
        <div class="relative">
          <div class="rounded-2xl banner-deep text-white p-8 md:p-12 flex flex-col md:flex-row items-center gap-6">
            <!-- left character -->
            <div class="flex-1 flex items-center">
              <div class="max-w-md">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">Hi, Fayza</h1>
                <p class="mt-3 text-white/90">Pantau aktivitas peminjaman dan koleksi terbaru hari ini.</p>
                <button class="mt-6 inline-block bg-white text-amber-700 font-semibold px-5 py-2 rounded-full shadow">Jelajahi Sekarang!</button>
              </div>
            </div>

            <!-- right book illustration -->
            <div class="flex-1 flex justify-end">
              <img src="{{ asset('images/banner-hero.png') }}" alt="hero" class="w-56 md:w-72 lg:w-80 object-contain">
            </div>
          </div>

          <!-- subtle horizontal white line like in design -->
          <div class="absolute left-8 right-8 -bottom-6 h-6"></div>
        </div>
      </section>

      <!-- MAIN GRID -->
      <main class="px-8 pb-12">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 -mt-2">

          <!-- left wide column (cards + chart) -->
          <div class="lg:col-span-2 space-y-6">

            <!-- STAT CARDS (three pastel cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
              <div class="stat-radius p-6 shadow-lg card-soft flex items-center gap-4 rounded-xl">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center" style="background:#ead3f8">
                  <img src="{{ asset('images/stat-book.png') }}" class="w-8 h-8" alt="book">
                </div>
                <div>
                  <div class="text-sm text-gray-600">Jumlah Buku</div>
                  <div class="stat-num text-gray-900">255</div>
                </div>
              </div>

              <div class="stat-radius p-6 shadow-lg card-soft flex items-center gap-4 rounded-xl">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center" style="background:#dbe7ff">
                  <img src="{{ asset('images/stat-user.png') }}" class="w-8 h-8" alt="user">
                </div>
                <div>
                  <div class="text-sm text-gray-600">Jumlah User</div>
                  <div class="stat-num text-gray-900">155</div>
                </div>
              </div>

              <div class="stat-radius p-6 shadow-lg card-soft flex items-center gap-4 rounded-xl">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center" style="background:#dff3b8">
                  <img src="{{ asset('images/stat-loan.png') }}" class="w-8 h-8" alt="loan">
                </div>
                <div>
                  <div class="text-sm text-gray-600">Buku Yang Sedang Dipinjam</div>
                  <div class="stat-num text-gray-900">155</div>
                </div>
              </div>
            </div>

            <!-- chart & small stats header -->
            <div class="p-6 rounded-xl shadow-lg bg-white">
              <div class="flex justify-between items-center mb-4">
                <div>
                  <div class="text-sm text-gray-600">Peminjaman & Pengembalian Buku (Per bulan)</div>
                  <div class="text-2xl font-bold">Total Peminjam <span class="text-amber-600">110</span></div>
                </div>

                <div class="flex items-center gap-4">
                  <!-- legend -->
                  <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-sm" style="background:#3b82f6"></div>
                    <div class="text-sm text-gray-600">Peminjam</div>
                  </div>
                  <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-sm" style="background:#86efac"></div>
                    <div class="text-sm text-gray-600">Pengembalian</div>
                  </div>
                </div>
              </div>

              <canvas id="loanChart" class="w-full" height="160"></canvas>
            </div>

          </div>

          <!-- right column (activity list) -->
          <div class="space-y-6">

            <div class="p-6 rounded-2xl shadow-lg bg-white h-full">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Aktivitas Pengguna Terbaru</h3>
                <button class="text-sm text-amber-600 font-medium">Lihat Semua</button>
              </div>

              <div class="max-h-[520px] overflow-auto scrollbar-thin pr-2">
                <!-- repeated activity items -->
                @php
                  $activities = [
                    ['name'=>'John Manuel', 'action'=>'Meminjam Buku', 'book'=>'Machine Learning', 'avatar'=>'avatar-1.png', 'note'=>''],
                    ['name'=>'Mahesa Bianca', 'action'=>'Mengembalikan Buku', 'book'=>'Cyber Security', 'avatar'=>'avatar-2.png', 'note'=>'Telat 3 hari'],
                    ['name'=>'Kimberlly Laurr', 'action'=>'Meminjam Buku', 'book'=>'Software Engineering', 'avatar'=>'avatar-3.png', 'note'=>''],
                    ['name'=>'John Manuel', 'action'=>'Meminjam Buku', 'book'=>'Machine Learning', 'avatar'=>'avatar-1.png', 'note'=>''],
                    ['name'=>'Mahesa Bianca', 'action'=>'Mengembalikan Buku', 'book'=>'Cyber Security', 'avatar'=>'avatar-2.png', 'note'=>'Telat 3 hari'],
                    ['name'=>'Kimberlly Laurr', 'action'=>'Meminjam Buku', 'book'=>'Software Engineering', 'avatar'=>'avatar-3.png', 'note'=>''],
                    ['name'=>'John Manuel', 'action'=>'Meminjam Buku', 'book'=>'Machine Learning', 'avatar'=>'avatar-1.png', 'note'=>''],
                  ];
                @endphp

                @foreach($activities as $act)
                  <div class="flex items-center gap-4 p-3 mb-3 rounded-lg activity-item shadow-sm">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/80">
                      <img src="{{ asset('images/' . $act['avatar']) }}" alt="avatar" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                      <div class="text-sm"><span class="font-semibold">{{ $act['name'] }}</span> <span class="text-gray-700"> {{ $act['action'] }} Buku <span class="font-bold">{{ $act['book'] }}</span></span></div>
                      @if($act['note'])
                        <div class="text-xs text-red-600 mt-1">{{ $act['note'] }}</div>
                      @endif
                    </div>

                    <div class="flex flex-col items-center gap-2">
                      <img src="{{ asset('images/icon-reminder.png') }}" alt="rem" class="w-5 h-5">
                    </div>
                  </div>
                @endforeach

              </div>
            </div>

          </div>

        </div>

        <!-- table lower section (optional) -->
        <div class="mt-8">
          <div class="p-6 rounded-xl shadow-lg bg-white">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold">Daftar Peminjaman Terakhir</h3>
              <div class="text-sm text-gray-500">Terbaru</div>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full text-left">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="py-3 px-4 text-sm text-gray-600">Judul Buku</th>
                    <th class="py-3 px-4 text-sm text-gray-600">Peminjam</th>
                    <th class="py-3 px-4 text-sm text-gray-600">Tanggal Pinjam</th>
                    <th class="py-3 px-4 text-sm text-gray-600">Status</th>
                    <th class="py-3 px-4 text-sm text-gray-600">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-t">
                    <td class="py-3 px-4">Machine Learning</td>
                    <td class="py-3 px-4">John Manuel</td>
                    <td class="py-3 px-4">10 Nov 2025</td>
                    <td class="py-3 px-4 text-amber-600 font-semibold">Dipinjam</td>
                    <td class="py-3 px-4"><button class="text-sm text-amber-600">Detail</button></td>
                  </tr>
                  <tr class="border-t">
                    <td class="py-3 px-4">Cyber Security</td>
                    <td class="py-3 px-4">Mahesa Bianca</td>
                    <td class="py-3 px-4">05 Nov 2025</td>
                    <td class="py-3 px-4 text-red-600 font-semibold">Terlambat</td>
                    <td class="py-3 px-4"><button class="text-sm text-amber-600">Detail</button></td>
                  </tr>
                  <tr class="border-t">
                    <td class="py-3 px-4">Software Engineering</td>
                    <td class="py-3 px-4">Kimberlly Laurr</td>
                    <td class="py-3 px-4">01 Nov 2025</td>
                    <td class="py-3 px-4 text-amber-600 font-semibold">Dipinjam</td>
                    <td class="py-3 px-4"><button class="text-sm text-amber-600">Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </main>

    </div> <!-- end main area -->
  </div>

  <!-- SCRIPTS: Chart -->
  <script>
    const ctx = document.getElementById('loanChart').getContext('2d');
    const loanChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Januari','Februari','Maret','April','Mei','Juni','Juli'],
        datasets: [
          {
            label: 'Peminjam',
            data: [40,50,30,35,38,42,43],
            backgroundColor: '#3b82f6',
            borderRadius: 6,
            barThickness: 18
          },
          {
            label: 'Pengembalian',
            data: [30,38,25,30,36,32,24],
            backgroundColor: '#86efac',
            borderRadius: 6,
            barThickness: 18
          }
        ]
      },
      options: {
        plugins: { legend: { display: false } },
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 10, color: '#333' },
            grid: { color: 'rgba(0,0,0,0.05)' }
          },
          x: {
            ticks: { color: '#333' },
            grid: { display: false }
          }
        }
      }
    });
  </script>

</body>
</html>