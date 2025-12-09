@php
    $title = 'Data Anggota - Staff';
    use App\Models\Pengguna;
    $anggota = Pengguna::where('peran', 'pengguna')->get();
@endphp
<x-staff-layout :title="$title">
    <section class="px-2 sm:px-4 pb-10 space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-[#7c1d0f]">Data Anggota (Staff)</h1>
            <p class="text-sm text-gray-700 mt-1">Kelola dan pantau anggota perpustakaan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            @php
                $totalAnggota = Pengguna::where('peran', 'pengguna')->count();
                $aktif = Pengguna::where('peran', 'pengguna')->count(); // Asumsi semua aktif jika tidak ada field status
                $nonaktif = 0;
                $anggotaBaru = Pengguna::where('peran', 'pengguna')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();
            @endphp
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $totalAnggota }}</h2>
                <p class="text-sm mt-1">Total Anggota</p>
            </div>
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $aktif }}</h2>
                <p class="text-sm mt-1">Aktif</p>
            </div>
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $nonaktif }}</h2>
                <p class="text-sm mt-1">Nonaktif</p>
            </div>
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $anggotaBaru }}</h2>
                <p class="text-sm mt-1">Anggota Baru</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                <div class="bg-white rounded-lg px-3 py-2 flex items-center border">
                    <x-icon name="search" class="w-5 h-5 text-gray-500 mr-2" />
                    <input type="text" id="searchInput" placeholder="Cari anggota (nama/email)" class="w-full outline-none text-sm" onkeyup="filterTable()">
                </div>
                <select id="statusFilter" class="border rounded-lg px-3 py-2 text-sm" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
                <input type="date" id="dateFilter" class="border rounded-lg px-3 py-2 text-sm" onchange="filterTable()">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#b54a38] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="anggotaTable" class="divide-y">
                        @foreach($anggota as $index => $row)
                        <tr class="odd:bg-gray-50 anggota-row" data-nama="{{ strtolower($row->nama) }}" data-email="{{ strtolower($row->email) }}" data-status="Aktif">
                            <td class="px-4 py-2">AG-{{ str_pad($row->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-2">{{ $row->nama }}</td>
                            <td class="px-4 py-2">{{ $row->email }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <button class="text-blue-600 text-xs font-semibold">Detail</button>
                                <button class="text-amber-600 text-xs font-semibold">Nonaktifkan</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="noResults" class="hidden text-center py-8 text-gray-500">
                    <p>Tidak ada data yang ditemukan</p>
                </div>
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
                // Log hanya untuk debugging
                if (console && console.log) {
                    console.log('Search performance logged:', { 
                        algorithm, 
                        processTime: processTime.toFixed(5) + 'ms', 
                        resultCount 
                    });
                }
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
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('.anggota-row');
            const noResults = document.getElementById('noResults');
            
            if (!searchInput || !statusFilter || !rows.length) return;
            
            const searchValue = searchInput.value.trim().toLowerCase();
            const statusValue = statusFilter.value;
            let visibleCount = 0;

            // Jika tidak ada input search, tampilkan semua berdasarkan filter status
            if (!searchValue) {
                rows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    const matchesStatus = !statusValue || status === statusValue;
                    row.style.display = matchesStatus ? '' : 'none';
                    if (matchesStatus) visibleCount++;
                });
                
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
                return;
            }

            // Pilih algoritma terbaik berdasarkan panjang pattern
            const algorithm = StringMatching.selectBestAlgorithm(searchValue);
            
            // Mulai timer untuk mengukur performa
            const startTime = performance.now();

            // Lakukan pencarian dengan algoritma string matching menggunakan service
            for (const row of rows) {
                const nama = row.getAttribute('data-nama') || '';
                const email = row.getAttribute('data-email') || '';
                const status = row.getAttribute('data-status') || '';
                
                // Gunakan algoritma string matching untuk mencari pattern
                const namaMatches = await StringMatching.searchWithAlgorithm(nama, searchValue, algorithm);
                const emailMatches = await StringMatching.searchWithAlgorithm(email, searchValue, algorithm);
                const matchesSearch = namaMatches.length > 0 || emailMatches.length > 0;
                const matchesStatus = !statusValue || status === statusValue;
                
                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            // Hitung waktu eksekusi dalam milidetik
            const processTime = performance.now() - startTime;

            // Log performa algoritma (tanpa tampilkan di UI)
            logSearchPerformance(searchValue, algorithm, processTime, visibleCount);

            // Tampilkan pesan jika tidak ada hasil
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }
        
        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan fungsi filterTable tersedia secara global
            window.filterTable = filterTable;
        });
    </script>
</x-staff-layout>

