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

    /* indikator kuning */
    #indicator {
        position: absolute;
        left: 0;
        top: 98px; 
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
        z-index:    5;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .menu-item img {
        width: 26px;
        height: 26px;
    }
</style>

</head>
<body class="page-gradient min-h-screen text-gray-800">

  <div class="flex">

<!-- SIDEBAR -->
<div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6 relative">

    <!-- INDIKATOR AKTIF -->
    <div id="indicator"></div>

    <!-- MENU ATAS -->
    <div class="flex flex-col items-center space-y-20 pt-20 w-full">
        <div class="menu-item"><img src="{{ asset('images/icon-home.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-anggota.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-buku.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-grafik.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-user.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-setting.png') }}"></div>
    </div>

    <!-- LOGOUT PALING BAWAH -->
    <img src="{{ asset('images/icon-logout.png') }}" class="w-7 mt-auto mb-4 cursor-pointer" onclick="window.location.href='{{ url('/logout') }}'">
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

        <!-- Profile (model sama seperti kelola-user) -->
        <div class="flex items-center space-x-2">
            <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
                A
            </div>

            <span class="text-black font-medium">Admin</span>

            <img src="{{ asset('images/icon-down-arrow.png') }}" class="w-4 ml-1">
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
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">Hi, Admin</h1>
                <p class="mt-3 text-white/90">Pantau aktivitas peminjaman dan koleksi terbaru hari ini.</p>
                <button class="mt-6 inline-block bg-white text-amber-700 font-semibold px-5 py-2 rounded-full shadow">Jelajahi Sekarang!</button>
              </div>
            </div>

            <!-- right book illustration -->
            <div class="flex-1 flex justify-end">
              <img src="{{ asset('images/icon-buku-halaman-admin.png') }}" alt="hero" class="w-72 md:w-80 lg:w-[380px] object-contain">
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
                  <img src="{{ asset('images/icon-buku-kecil.png') }}" class="w-11 h-11" alt="book">
                </div>
                <div>
                  <div class="text-sm text-gray-600">Jumlah Buku</div>
                  <div class="stat-num text-gray-900">255</div>
                </div>
              </div>

              <div class="stat-radius p-6 shadow-lg card-soft flex items-center gap-4 rounded-xl">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center" style="background:#dbe7ff">
                  <img src="{{ asset('images/icon-user-kecil.png') }}" class="w-12 h-12" alt="user">
                </div>
                <div>
                  <div class="text-sm text-gray-600">Jumlah User</div>
                  <div class="stat-num text-gray-900">155</div>
                </div>
              </div>

              <div class="stat-radius p-6 shadow-lg card-soft flex items-center gap-4 rounded-xl">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center" style="background:#dff3b8">
                  <img src="{{ asset('images/icon-buku-dipinjam.png') }}" class="w-10 h-10" alt="loan">
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
                    ['name'=>'Ikbal Ramadan',   'action'=>'Ingin Meminjam',     'book'=>'Machine Learning',              'avatar'=>'icon-profil1.png', 'note'=>'',            'type'=>'pinjam'],
                    ['name'=>'Siti Nurfadila Ilham', 'action'=>'Mengembalikan','book'=>'Cyber Security',                'avatar'=>'icon-profil3.png', 'note'=>'Telat 3 hari','type'=>'telat'],
                    ['name'=>'Angie Palealu','action'=>'Ingin Meminjam',    'book'=>'Software Engineering',          'avatar'=>'icon-profil2.png', 'note'=>'',            'type'=>'pinjam'],
                    ['name'=>'Jerome',      'action'=>'Ingin Meminjam',     'book'=>'Kriptografi',                   'avatar'=>'icon-profil4.png', 'note'=>'',            'type'=>'pinjam'],
                    ['name'=>'Nuriyanti',       'action'=>'Mengembalikan','book'=>'E-bisnis',                      'avatar'=>'icon-profil5.png', 'note'=>'Telat 7 hari','type'=>'telat'],
                    ['name'=>'Kaysa Dzikirya','action'=>'Menunggu Konfirmasi Peminjaman','book'=>'Pengembangan Perangkat Lunak', 'avatar'=>'icon-profil6.png', 'note'=>'',            'type'=>'kembali'],
                  ];
                @endphp

                @foreach($activities as $act)
                <div class="flex items-center gap-4 p-3 mb-3 rounded-lg activity-item shadow-sm">

                  <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/80">
                    <img src="{{ asset('images/' . $act['avatar']) }}" class="w-full h-full object-cover">
                  </div>

                  <div class="flex-1">
                    <div class="text-sm">
                      <span class="font-semibold">{{ $act['name'] }}</span>
                      <span class="text-gray-700"> {{ $act['action'] }} Buku 
                        <span class="font-bold">{{ $act['book'] }}</span>
                      </span>
                    </div>

                    @if(!empty($act['note']))
                      <div class="text-xs text-red-600 mt-1">{{ $act['note'] }}</div>
                    @endif
                  </div>

                  <!-- ICON DENGAN DATA ATTRIBUTE UNTUK MODAL -->
                  <div>
                    @if($act['type'] === 'pinjam')
                      <img src="{{ asset('images/icon-cekbuku.png') }}" class="w-5 h-5 cursor-pointer" 
                          data-name="{{ $act['name'] }}" 
                          data-action="{{ $act['action'] }}" 
                          data-book="{{ $act['book'] }}" 
                          data-note="{{ $act['note'] }}" 
                          data-type="Pinjam">
                    @elseif($act['type'] === 'telat')
                      <img src="{{ asset('images/icon-denda.png') }}" class="w-5 h-5 cursor-pointer" 
                          data-name="{{ $act['name'] }}" 
                          data-action="{{ $act['action'] }}" 
                          data-book="{{ $act['book'] }}" 
                          data-note="{{ $act['note'] }}" 
                          data-type="Denda">
                    @elseif($act['type'] === 'kembali')
                      <img src="{{ asset('images/icon-reminder.png') }}" class="w-5 h-5 cursor-pointer" 
                          data-name="{{ $act['name'] }}" 
                          data-action="{{ $act['action'] }}" 
                          data-book="{{ $act['book'] }}" 
                          data-note="{{ $act['note'] }}" 
                          data-type="Reminder">
                    @endif
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
                    <td class="py-3 px-4">
                      <button class="text-sm text-indigo-600 hover:underline detail-btn"
                          data-book="Machine Learning"
                          data-user="John Manuel"
                          data-date="10 Nov 2025"
                          data-status="Dipinjam">
                        Detail
                      </button>
                    </td>
                  </tr>
                  <tr class="border-t">
                    <td class="py-3 px-4">Cyber Security</td>
                    <td class="py-3 px-4">Mahesa Bianca</td>
                    <td class="py-3 px-4">05 Nov 2025</td>
                    <td class="py-3 px-4 text-red-600 font-semibold">Terlambat</td>
                    <td class="py-3 px-4">
                      <button class="text-sm text-indigo-600 hover:underline detail-btn"
                          data-book="Cyber Security"
                          data-user="Mahesa Bianca"
                          data-date="05 Nov 2025"
                          data-status="Terlambat">
                        Detail
                      </button>
                    </td>
                  </tr>
                  <tr class="border-t">
                    <td class="py-3 px-4">Software Engineering</td>
                    <td class="py-3 px-4">Kimberlly Laurr</td>
                    <td class="py-3 px-4">01 Nov 2025</td>
                    <td class="py-3 px-4 text-amber-600 font-semibold">Dipinjam</td>
                    <td class="py-3 px-4">
                      <button class="text-sm text-indigo-600 hover:underline detail-btn"
                          data-book="Software Engineering"
                          data-user="Kimberlly Laurr"
                          data-date="01 Nov 2025"
                          data-status="Dipinjam">
                        Detail
                      </button>
                    </td>
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

 <!-- SCRIPT PINDAH INDIKATOR -->
<script>
const indicator = document.getElementById('indicator');
const menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach((item, index) => {
    item.addEventListener('click', () => {
        // pindahkan indikator sesuai icon
        const baseTop = 204; // top icon pertama
        const spacing = 95; // jarak antar icon (sesuai data-anggota)
        indicator.style.top = (baseTop + spacing * index) + 'px';

        // arahkan ke halaman sesuai menu
        if (index === 0) window.location.href = "/admin";
        if (index === 1) window.location.href = "/data-anggota";
        if (index === 2) window.location.href = "/kelola-buku";
        if (index === 3) window.location.href = "/laporan-peminjaman";
        if (index === 4) window.location.href = "/kelola-user";
        if (index === 5) window.location.href = "/pengaturan";
    });
});
</script>

<!-- MODAL DETAIL AKTIVITAS -->
<div id="activityModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl p-6 w-96 relative">
    <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-900">&times;</button>
    <h3 class="text-lg font-semibold mb-4">Detail Aktivitas</h3>
    <div id="modalContent" class="text-gray-700"></div>
  </div>
</div>

<script>
const tableModal = document.getElementById('activityModal'); // pakai modal yang sama
const tableModalContent = document.getElementById('modalContent');

document.querySelectorAll('.detail-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const book = btn.dataset.book;
    const user = btn.dataset.user;
    const date = btn.dataset.date;
    const status = btn.dataset.status;

    tableModalContent.innerHTML = `
      <p><span class="font-semibold">Buku:</span> ${book}</p>
      <p><span class="font-semibold">Peminjam:</span> ${user}</p>
      <p><span class="font-semibold">Tanggal Pinjam:</span> ${date}</p>
      <p><span class="font-semibold">Status:</span> ${status}</p>
    `;

    tableModal.classList.remove('hidden');
    tableModal.classList.add('flex');
  });
});
</script>

<!-- SCRIPT MODAL -->
<script>
const modal = document.getElementById('activityModal');
const modalContent = document.getElementById('modalContent');
const closeModal = document.getElementById('closeModal');

const activityIcons = document.querySelectorAll('.activity-item img');

activityIcons.forEach(icon => {
  icon.addEventListener('click', () => {
    const name = icon.dataset.name;
    const action = icon.dataset.action;
    const book = icon.dataset.book;
    const note = icon.dataset.note;
    const type = icon.dataset.type;

    modalContent.innerHTML = `
      <p><span class="font-semibold">Nama:</span> ${name}</p>
      <p><span class="font-semibold">Aksi:</span> ${action}</p>
      <p><span class="font-semibold">Buku:</span> ${book}</p>
      ${note ? `<p><span class="font-semibold">Catatan:</span> ${note}</p>` : ''}
      <p><span class="font-semibold">Jenis:</span> ${type}</p>
    `;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
  });
});

closeModal.addEventListener('click', () => {
  modal.classList.add('hidden');
  modal.classList.remove('flex');
});

modal.addEventListener('click', (e) => {
  if(e.target === modal){
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }
});
</script>

</body>
</html>