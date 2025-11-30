<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Perpustakaan</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS KAMU (warna & desain tetap) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="h-screen m-0 p-0">

    <div class="w-full h-full flex flex-col md:flex-row p-0">

        <!-- LEFT -->
        <div class="left w-full md:w-1/2 flex items-center justify-center p-4">
            <img src="{{ asset('images/ilustration.png') }}" 
                 alt="gambar" 
                 class="ilustrasi max-w-full h-auto">
        </div>

        <!-- RIGHT -->
        <div class="right w-full md:w-1/2 flex items-center justify-center p-4">
            <div class="card-custom text-center">
                
                <div class="title">APLIKASI MANAJEMEN PERPUSTAKAAN</div>
                <hr class="my-3">

                <div class="subtitle">Hello! Selamat Datang</div>

                <button 
                    class="btn-custom mb-3"
                    onclick="window.location.href='{{ url('/login') }}'">
                    MASUK
                </button>

                <button 
                    class="btn-custom"
                    onclick="window.location.href='{{ url('/register') }}'">
                    DAFTAR
                </button>

            </div>
        </div>

    </div>

</body>
</html>