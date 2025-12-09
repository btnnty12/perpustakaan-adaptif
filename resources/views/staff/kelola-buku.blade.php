@php($title = 'Kelola Buku - Staff')
<x-staff-layout :title="$title">
    <section class="px-2 sm:px-4 pb-10 space-y-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-[#7c1d0f]">Kelola Buku (Staff)</h1>
                <p class="text-sm text-gray-700 mt-1">Kelola koleksi buku perpustakaan.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('staff.kelola-buku.create') }}" class="bg-[#a63a2d] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:brightness-95">Tambah Buku</a>
                <a href="{{ route('staff.kelola-buku.import') }}" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-50">Import Excel</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-3 bg-white rounded-xl shadow p-4">
                <div class="flex flex-wrap gap-3 mb-4">
                    <input type="text" id="searchInput" placeholder="Cari judul / penulis" class="w-full md:w-64 border rounded-lg px-3 py-2 text-sm" onkeyup="filterTable()">
                    <select id="kategoriFilter" class="border rounded-lg px-3 py-2 text-sm" onchange="filterTable()">
                        <option value="">Semua Kategori</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Keamanan">Keamanan</option>
                    </select>
                    <select id="statusFilter" class="border rounded-lg px-3 py-2 text-sm" onchange="filterTable()">
                        <option value="">Semua Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-2 text-left">Judul</th>
                                <th class="px-3 py-2 text-left">Penulis</th>
                                <th class="px-3 py-2 text-left">Kategori</th>
                                <th class="px-3 py-2 text-left">Stok</th>
                                <th class="px-3 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach([
                                ['judul'=>'Machine Learning','penulis'=>'Andrew Ng','kat'=>'Teknologi','stok'=>12,'status'=>'Tersedia'],
                                ['judul'=>'Cyber Security','penulis'=>'Kevin Mitnick','kat'=>'Keamanan','stok'=>4,'status'=>'Dipinjam'],
                            ] as $row)
                            <tr class="buku-row" data-judul="{{ strtolower($row['judul']) }}" data-penulis="{{ strtolower($row['penulis']) }}" data-kategori="{{ $row['kat'] }}" data-status="{{ $row['status'] }}">
                                <td class="px-3 py-2">{{ $row['judul'] }}</td>
                                <td class="px-3 py-2">{{ $row['penulis'] }}</td>
                                <td class="px-3 py-2">{{ $row['kat'] }}</td>
                                <td class="px-3 py-2">{{ $row['stok'] }}</td>
                                <td class="px-3 py-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $row['status']=='Tersedia' ? 'bg-green-100 text-green-700':'bg-amber-100 text-amber-700' }}">
                                        {{ $row['status'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="noResults" class="hidden text-center py-8 text-gray-500">
                        <p>Tidak ada buku yang ditemukan.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4 space-y-4">
                <h3 class="text-lg font-bold text-gray-800">Profil Staff</h3>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-amber-200 flex items-center justify-center text-amber-800 font-bold text-lg">
                        {{ strtoupper(substr(session('nama', 'ST'), 0, 2)) }}
                    </div>
                    <div>
                        <div class="text-base font-semibold text-gray-800">{{ session('nama', 'Staff') }}</div>
                        <div class="text-xs text-gray-600">{{ session('email', 'staff@example.com') }}</div>
                        <div class="text-xs text-gray-500 mt-1">Peran: Staff</div>
                    </div>
                </div>
                <a href="{{ route('staff.pengaturan') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-[#a63a2d] text-white rounded-lg text-xs font-semibold hover:brightness-95">
                    <x-icon name="setting" class="w-4 h-4 text-white" /> Edit Profil
                </a>
            </div>
        </div>
    </section>

    <script>
        // Menggunakan StringMatchingService dari service
        const StringMatching = window.StringMatchingService;

        // Fungsi untuk log performa (mengirim ke backend)
        async function logSearchPerformance(keyword, algorithm, processTime, resultCount) {
            if (!keyword || keyword.trim() === '') return;
            
            try {
                const response = await fetch('{{ route("staff.log-search") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        kata_kunci: keyword,
                        algorithm: algorithm,
                        process_time_ms: parseFloat(processTime.toFixed(5)),
                        jumlah_hasil: resultCount
                    })
                });
                
                if (!response.ok) {
                    throw new Error('Failed to log');
                }
            } catch (error) {
                // Silent fail - tidak tampilkan error di UI
            }
        }

        // ======================================================
        // FUNGSI FILTER TABLE DENGAN ALGORITMA
        // ======================================================
        let searchTimeout;
        
        function filterTable() {
            // Debounce untuk menghindari terlalu banyak eksekusi
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                executeSearch();
            }, 150); // Delay 150ms
        }
        
        async function executeSearch() {
            const searchInput = document.getElementById('searchInput');
            const kategoriFilter = document.getElementById('kategoriFilter');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('.buku-row');
            const noResults = document.getElementById('noResults');
            
            if (!searchInput || !rows.length) return;
            
            const searchValue = searchInput.value.trim().toLowerCase();
            const kategoriValue = kategoriFilter ? kategoriFilter.value : '';
            const statusValue = statusFilter ? statusFilter.value : '';
            let visibleCount = 0;

            // Jika tidak ada input search, tampilkan semua berdasarkan filter
            if (!searchValue && !kategoriValue && !statusValue) {
                rows.forEach(row => {
                    row.style.display = '';
                    visibleCount++;
                });
                if (noResults) noResults.classList.add('hidden');
                return;
            }

            // Pilih algoritma terbaik berdasarkan panjang pattern
            const algorithm = StringMatching.selectBestAlgorithm(searchValue);
            
            // Mulai timer untuk mengukur performa
            const startTime = performance.now();

            // Lakukan pencarian dengan algoritma string matching menggunakan service
            for (const row of rows) {
                const judul = row.getAttribute('data-judul') || '';
                const penulis = row.getAttribute('data-penulis') || '';
                const kategori = row.getAttribute('data-kategori') || '';
                const status = row.getAttribute('data-status') || '';
                
                let matchesSearch = true;
                if (searchValue) {
                    const judulMatches = await StringMatching.searchWithAlgorithm(judul, searchValue, algorithm);
                    const penulisMatches = await StringMatching.searchWithAlgorithm(penulis, searchValue, algorithm);
                    matchesSearch = judulMatches.length > 0 || penulisMatches.length > 0;
                }
                
                const matchesKategori = !kategoriValue || kategori === kategoriValue;
                const matchesStatus = !statusValue || status === statusValue;
                
                if (matchesSearch && matchesKategori && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            // Hitung waktu eksekusi dalam milidetik
            const processTime = performance.now() - startTime;

            // Log performa algoritma (tanpa tampilkan di UI)
            if (searchValue) {
                logSearchPerformance(searchValue, algorithm, processTime, visibleCount);
            }

            // Tampilkan pesan jika tidak ada hasil
            if (noResults) {
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
            }
        }
    </script>
</x-staff-layout>

