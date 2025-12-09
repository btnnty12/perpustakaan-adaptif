@php
    $title = 'Laporan Peminjaman - Staff';
    use App\Models\Pinjaman;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;
    
    $pinjaman = Pinjaman::with(['pengguna', 'buku'])->orderBy('created_at', 'desc')->get();
    
    // Hitung statistik
    $totalDipinjam = Pinjaman::count();
    $sedangDipinjam = Pinjaman::where('status', 'sedang_dipinjam')->count();
    
    // Cek apakah kolom ada di database
    $hasTanggalJatuhTempo = Schema::hasColumn('pinjaman', 'tanggal_jatuh_tempo');
    $hasDenda = Schema::hasColumn('pinjaman', 'denda');
    
    // Hitung terlambat dengan pengecekan kolom
    $terlambat = 0;
    if ($hasTanggalJatuhTempo) {
        try {
            $terlambat = Pinjaman::where('status', 'sedang_dipinjam')
                ->whereNotNull('tanggal_jatuh_tempo')
                ->whereDate('tanggal_jatuh_tempo', '<', Carbon::now()->toDateString())
                ->count();
        } catch (\Exception $e) {
            $terlambat = 0;
        }
    }
    
    // Hitung total denda dengan pengecekan kolom
    $totalDenda = 0;
    if ($hasDenda) {
        try {
            $totalDenda = Pinjaman::whereNotNull('denda')->sum('denda') ?? 0;
        } catch (\Exception $e) {
            $totalDenda = 0;
        }
    }
@endphp
<x-staff-layout :title="$title">
    <section class="px-2 sm:px-4 pb-10 space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-[#7c1d0f]">Laporan Peminjaman (Staff)</h1>
            <p class="text-sm text-gray-700 mt-1">Pantau peminjaman, pengembalian, dan keterlambatan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $totalDipinjam }}</h2>
                <p class="text-sm mt-1">Total Buku Dipinjam</p>
            </div>
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $sedangDipinjam }}</h2>
                <p class="text-sm mt-1">Sedang Dipinjam</p>
            </div>
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">{{ $terlambat }}</h2>
                <p class="text-sm mt-1">Terlambat</p>
            </div>
            <div class="bg-[#b94a36] text-white rounded-lg p-4 text-center shadow">
                <h2 class="text-2xl font-bold">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h2>
                <p class="text-sm mt-1">Denda Terkumpul</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-4">
            <div class="flex flex-wrap gap-3 items-center mb-4">
                <div class="flex items-center border rounded-lg px-3 py-2 flex-1 min-w-[200px]">
                    <x-icon name="search" class="w-5 h-5 text-gray-500 mr-2" />
                    <input type="text" id="searchInput" placeholder="Cari nama / judul buku" class="w-full outline-none text-sm" onkeyup="filterTable()">
                </div>
                <select id="statusFilter" class="border rounded-lg px-3 py-2 text-sm" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="sedang_dipinjam">Sedang Dipinjam</option>
                    <option value="terlambat">Terlambat</option>
                    <option value="dikembalikan">Dikembalikan</option>
                </select>
                <input type="date" id="dateFilter" class="border rounded-lg px-3 py-2 text-sm" onchange="filterTable()">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#b54a38] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">ID Transaksi</th>
                            <th class="px-4 py-3 text-left">Nama Anggota</th>
                            <th class="px-4 py-3 text-left">Judul Buku</th>
                            <th class="px-4 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Denda</th>
                        </tr>
                    </thead>
                    <tbody id="pinjamanTable" class="divide-y">
                        @foreach($pinjaman as $row)
                        @php
                            $statusDisplay = '';
                            $statusClass = '';
                            $isTerlambat = false;
                            
                            if ($row->status === 'dikembalikan') {
                                $statusDisplay = 'Dikembalikan';
                                $statusClass = 'bg-green-100 text-green-700';
                            } elseif ($row->status === 'sedang_dipinjam') {
                                if ($hasTanggalJatuhTempo && property_exists($row, 'tanggal_jatuh_tempo') && $row->tanggal_jatuh_tempo) {
                                    try {
                                        if (Carbon::parse($row->tanggal_jatuh_tempo)->isPast()) {
                                            $statusDisplay = 'Terlambat';
                                            $statusClass = 'bg-red-100 text-red-700';
                                            $isTerlambat = true;
                                        } else {
                                            $statusDisplay = 'Sedang Dipinjam';
                                            $statusClass = 'bg-amber-100 text-amber-700';
                                        }
                                    } catch (\Exception $e) {
                                        $statusDisplay = 'Sedang Dipinjam';
                                        $statusClass = 'bg-amber-100 text-amber-700';
                                    }
                                } else {
                                    $statusDisplay = 'Sedang Dipinjam';
                                    $statusClass = 'bg-amber-100 text-amber-700';
                                }
                            } else {
                                $statusDisplay = ucfirst(str_replace('_', ' ', $row->status));
                                $statusClass = 'bg-gray-100 text-gray-700';
                            }
                            
                            // Handle denda dengan pengecekan kolom
                            $dendaValue = 0;
                            if ($hasDenda) {
                                try {
                                    if (property_exists($row, 'denda') && $row->denda !== null && $row->denda > 0) {
                                        $dendaValue = $row->denda;
                                    }
                                } catch (\Exception $e) {
                                    $dendaValue = 0;
                                }
                            }
                            $dendaDisplay = $dendaValue > 0 ? 'Rp ' . number_format($dendaValue, 0, ',', '.') : '-';
                        @endphp
                        <tr class="odd:bg-gray-50 pinjaman-row" 
                            data-nama="{{ strtolower($row->pengguna->nama ?? '') }}" 
                            data-judul="{{ strtolower($row->buku->judul ?? '') }}"
                            data-status="{{ $isTerlambat ? 'terlambat' : $row->status }}"
                            data-tanggal="{{ $row->tanggal_pinjam ? Carbon::parse($row->tanggal_pinjam)->format('Y-m-d') : '' }}">
                            <td class="px-4 py-2">P-{{ str_pad($row->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-2">{{ $row->pengguna->nama ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $row->buku->judul ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $row->tanggal_pinjam ? Carbon::parse($row->tanggal_pinjam)->format('d M Y') : '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ $statusDisplay }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $dendaDisplay }}</td>
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

        async function logSearchPerformance(keyword, algorithm, processTime, resultCount) {
            if (!keyword || keyword.trim() === '') return;
            try {
                await fetch('{{ route("staff.log-search") }}', {
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
            } catch (error) {
                console.log('Search performance logged:', { algorithm, processTime: processTime.toFixed(5) + 'ms', resultCount });
            }
        }

        // ======================================================
        // FUNGSI FILTER TABLE
        // ======================================================
        let searchTimeout;
        
        function filterTable() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                executeSearch();
            }, 150);
        }
        
        async function executeSearch() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const dateFilter = document.getElementById('dateFilter');
            const rows = document.querySelectorAll('.pinjaman-row');
            const noResults = document.getElementById('noResults');
            
            if (!searchInput || !statusFilter || !rows.length) return;
            
            const searchValue = searchInput.value.trim().toLowerCase();
            const statusValue = statusFilter.value;
            const dateValue = dateFilter ? dateFilter.value : '';
            let visibleCount = 0;

            if (!searchValue && !statusValue && !dateValue) {
                rows.forEach(row => {
                    row.style.display = '';
                    visibleCount++;
                });
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                } else {
                    noResults.classList.add('hidden');
                }
                return;
            }

            const algorithm = StringMatching.selectBestAlgorithm(searchValue);
            const startTime = performance.now();

            // Lakukan pencarian dengan algoritma string matching menggunakan service
            for (const row of rows) {
                const nama = row.getAttribute('data-nama') || '';
                const judul = row.getAttribute('data-judul') || '';
                const status = row.getAttribute('data-status') || '';
                const tanggal = row.getAttribute('data-tanggal') || '';
                
                let matchesSearch = true;
                if (searchValue) {
                    const namaMatches = await StringMatching.searchWithAlgorithm(nama, searchValue, algorithm);
                    const judulMatches = await StringMatching.searchWithAlgorithm(judul, searchValue, algorithm);
                    matchesSearch = namaMatches.length > 0 || judulMatches.length > 0;
                }
                
                const matchesStatus = !statusValue || status === statusValue;
                const matchesDate = !dateValue || tanggal === dateValue;
                
                if (matchesSearch && matchesStatus && matchesDate) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            const processTime = performance.now() - startTime;
            if (searchValue) {
                logSearchPerformance(searchValue, algorithm, processTime, visibleCount);
            }

            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            window.filterTable = filterTable;
        });
    </script>
</x-staff-layout>

