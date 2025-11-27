<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Notifikasi Perpustakaan</title>
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- NOTIFIKASI BIASA (BIRU) -->
    <div class="space-y-4">

      <!-- Item -->
      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">📘</span>
        <p class="text-sm font-medium">Peminjaman buku "Clean Code" berhasil. Kembalikan sebelum 10 Oktober 2025.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">📘</span>
        <p class="text-sm font-medium">Buku "Machine Learning" harus dikembalikan dalam 3 hari lagi.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">📘</span>
        <p class="text-sm font-medium">Buku "Sistem Basis Data" terlambat dikembalikan 2 hari.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">📚</span>
        <p class="text-sm font-medium">Buku baru "AI for Everyone" sudah tersedia di rak Teknologi.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">💡</span>
        <p class="text-sm font-medium">Rekomendasi untuk kamu: "Neural Networks Simplified".</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">⚠️</span>
        <p class="text-sm font-medium">Aplikasi akan maintenance 1 November, 22.00–23.00 WIB.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">📦</span>
        <p class="text-sm font-medium">Buku "Docker for Beginners" siap diambil di loket perpustakaan.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">📘</span>
        <p class="text-sm font-medium">Buku "Etika Profesi IT" kini tersedia kembali di koleksi kampus.</p>
      </div>

      <div class="bg-blue-100 rounded-xl p-4 shadow flex gap-3 items-start">
        <span class="text-3xl">👤</span>
        <p class="text-sm font-medium">Profil kamu berhasil diperbarui.</p>
      </div>

    </div>


    <!-- PESAN (ABU-ABU) -->
    <div class="space-y-4">

      <div class="bg-gray-200 p-4 rounded-xl shadow">
        <p class="font-semibold text-sm">Perpus</p>
        <div class="flex gap-3 mt-2">
          <span class="text-3xl">👤</span>
          <p class="text-sm">Halo Fayza, peminjaman buku Clean Code kamu sudah disetujui. Silakan ambil di loket perpustakaan.</p>
        </div>
        <div class="flex justify-end mt-2 text-xs gap-4">
          <button class="text-red-500">Hapus</button>
          <button class="text-blue-500">Balas</button>
        </div>
      </div>

      <div class="bg-gray-200 p-4 rounded-xl shadow">
        <p class="font-semibold text-sm">Perpus</p>
        <div class="flex gap-3 mt-2">
          <span class="text-3xl">👤</span>
          <p class="text-sm">Hai Fayza, jangan lupa buku Machine Learning dikembalikan sebelum 10 Oktober 2025, ya.</p>
        </div>
        <div class="flex justify-end mt-2 text-xs gap-4">
          <button class="text-red-500">Hapus</button>
          <button class="text-blue-500">Balas</button>
        </div>
      </div>

      <div class="bg-gray-200 p-4 rounded-xl shadow">
        <p class="font-semibold text-sm">Perpus</p>
        <div class="flex gap-3 mt-2">
          <span class="text-3xl">👤</span>
          <p class="text-sm">Peminjaman buku Sistem Basis Data kamu terlambat dikembalikan 2 hari. Total denda sementara: Rp4.000. Silakan lakukan pembayaran di loket.</p>
        </div>
        <div class="flex justify-end mt-2 text-xs gap-4">
          <button class="text-red-500">Hapus</button>
          <button class="text-blue-500">Balas</button>
        </div>
      </div>

      <div class="bg-gray-200 p-4 rounded-xl shadow">
        <p class="font-semibold text-sm">Perpus</p>
        <div class="flex gap-3 mt-2">
          <span class="text-3xl">👤</span>
          <p class="text-sm">Pengingat denda kamu sebesar Rp10.000 untuk keterlambatan pengembalian buku Statistika Terapan. Mohon segera dilunasi.</p>
        </div>
        <div class="flex justify-end mt-2 text-xs gap-4">
          <button class="text-red-500">Hapus</button>
          <button class="text-blue-500">Balas</button>
        </div>
      </div>

    </div>

  </div>

</body>
</html>