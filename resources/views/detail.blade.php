<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book['title'] }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        .fav-animate { transform: scale(1.25); transition: 0.15s; }
    </style>
</head>

<body class="bg-gradient-to-b from-yellow-100 to-yellow-200 min-h-screen">

<!-- BACK BUTTON -->
<a href="{{ route('home') }}"
   class="absolute top-6 left-6 flex items-center space-x-3 bg-white shadow-lg px-4 py-2 rounded-full hover:scale-105 transition">
    <i class="fa-solid fa-arrow-left text-[#C34722] text-xl"></i>
    <span class="font-semibold text-[#C34722]">Kembali</span>
</a>

<div class="container mx-auto px-6 pt-24 pb-16 max-w-5xl">

    <div class="bg-white shadow-2xl rounded-3xl p-10 grid grid-cols-2 gap-10">

        <!-- Cover -->
        <div class="flex justify-center">
            <img src="{{ $book['img'] }}"
                 class="w-72 h-[420px] object-cover rounded-2xl shadow-xl border-4 border-[#C34722]">
        </div>

        <!-- Info -->
        <div class="flex flex-col justify-between">

            <div>
                <h1 class="text-4xl font-bold text-[#C34722] leading-snug">
                    {{ $book['title'] }}
                </h1>
                <p class="text-lg text-gray-600 mt-2 font-medium">
                    {{ $book['author'] }} — {{ $book['year'] }}
                </p>
            </div>

            <div class="mt-6 text-gray-700 leading-relaxed pr-3">
                {{ $book['desc'] }}
            </div>

            <div class="bg-[#F4D2C1] text-black p-4 rounded-2xl mt-8 shadow">
                <p class="font-semibold">• Genre: {{ $book['genre'] }}</p>
                <p class="font-semibold">• Stok tersedia: {{ $book['stok'] }} buku</p>
                <p class="font-semibold">• Bahasa: {{ $book['bahasa'] }}</p>
            </div>

            <!-- FAVORITE BUTTON -->
            @php
                $sessionFavs = session('favorites', []);
                $isFav = in_array($book['title'], $sessionFavs, true);
            @endphp

            <form method="POST" action="{{ route('favorite.toggle', $book['title']) }}">
                @csrf
                <button type="submit"
                    class="mt-6 w-full py-3 rounded-2xl font-bold text-lg shadow-lg flex items-center justify-center gap-3
                           transition transform hover:scale-105
                           {{ $isFav ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                    <i class="{{ $isFav ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                    {{ $isFav ? 'Favorit' : 'Tambah ke Favorit' }}
                </button>
            </form>

            <!-- PINJAM BUTTON -->
            <button onclick="window.location.href='{{ route('pengembalian.create', [
                'title' => $book['title'], 
                'author' => $book['author'], 
                'year' => $book['year']
            ]) }}'"
                class="mt-6 w-full bg-[#C34722] text-white py-4 rounded-2xl font-bold text-lg hover:bg-[#B13C1D] transition shadow-lg">
                Pinjam Sekarang
            </button>

        </div>
    </div>

</div>

<!-- TOAST POP-UP FAVORITE -->
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
    // Animasi love button
    document.querySelectorAll('form button').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.add('fav-animate');
            setTimeout(()=> btn.classList.remove('fav-animate'), 150);
        });
    });
</script>

</body>
</html>