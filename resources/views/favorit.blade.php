<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Favorit - Perpustakaan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        .fav-animate { transform: scale(1.25); transition: 0.15s; }
        .book-card { cursor: pointer; }
    </style>
</head>

<body class="bg-gradient-to-b from-yellow-200 to-yellow-300 min-h-screen flex">

<!-- SIDEBAR -->
<aside id="sidebar" class="w-20 bg-[#C34722] text-white flex flex-col items-center py-6 shadow-lg relative">
    <div id="menuWrapper" class="relative flex flex-col items-center space-y-8 flex-1">
        <div id="highlight" class="absolute left-0 w-16 h-12 bg-white/30 rounded-xl transition-all duration-300 shadow-md -z-10" style="top: 0;"></div>
        <button onclick="window.location.href='/home';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-house"></i></button>
        <button onclick="window.location.href='/search';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-magnifying-glass"></i></button>
       <button onclick="window.location.href='/pengembalian-buku';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-file-lines"></i></button>
        <button onclick="window.location.href='/pinjaman';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-book"></i></button>
        <button onclick="window.location.href='/favorit';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-heart"></i></button>
        <button onclick="window.location.href='/pengaturan';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-gear"></i></button>
        <button onclick="window.location.href='{{ url('/logout') }}'" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100 mb-4 mt-auto"><i class="fa-solid fa-right-from-bracket"></i></button>
    </div>
</aside>

@php
    $sessionFavs = $favorites ?? [];
    $dataFavorit = $favoriteBooks ?? [];
@endphp

<!-- MAIN CONTENT -->
<main class="flex-1 p-8">
    <h1 class="text-4xl font-bold mb-6 text-[#A63A2D]">Buku Favoritmu</h1>
    <p class="text-gray-700 mb-8">Lihat buku-buku yang sudah kamu tandai sebagai favorit.</p>
    
    @if(empty($dataFavorit))
        <p class="text-gray-700">Belum ada buku yang kamu tandai sebagai favorit. Klik ❤️ di buku yang kamu suka!</p>
    @else
        <div class="flex gap-6 pb-4 flex-wrap">
            @foreach($dataFavorit as $fav)
                @php
                    $judul     = $fav['title'];
                    $pengarang = $fav['author'];
                    $tahun     = $fav['year'];
                    $cover     = $fav['img'];
                    $slug      = $fav['title'];
                    $isFav     = in_array($slug, $sessionFavs, true);
                @endphp

                <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-lg min-w-[200px] book-card cursor-pointer"
                     onclick="window.location.href='{{ route('detail', $slug) }}'">
                    <img src="{{ $cover }}" class="w-36 h-48 object-cover rounded-xl shadow mb-2">
                    <p class="font-semibold text-center text-lg">{{ $judul }}</p>
                    <p class="text-gray-600 text-sm mt-1">{{ $pengarang }} - {{ $tahun }}</p>

                    <!-- FAVORITE BUTTON -->
                    <form action="{{ route('favorite.toggle', $slug) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="text-3xl transition transform hover:scale-125" onclick="animate(this)">
                            <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart {{ $isFav ? 'text-red-500' : 'text-gray-400' }}"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</main>

<!-- POP-UP FAVORITE -->
@if(session('success'))
    <div id="toast" class="fixed bottom-10 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg opacity-0 transition-opacity duration-500 z-50">
        {{ session('success') }}
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('toast');
            if(toast){
                toast.style.opacity = '1';
                setTimeout(() => { toast.style.opacity = '0'; }, 2000);
            }
        });
    </script>
@endif

<script>
    // Animasi tombol love
    function animate(btn){
        btn.classList.add("fav-animate");
        setTimeout(()=>{ btn.classList.remove("fav-animate"); }, 150);
    }
</script>

</body>
</html>