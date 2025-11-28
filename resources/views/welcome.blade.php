<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Perpustakaan</title>

    <!-- BOOTSTRAP ONLINE (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE TERPISAH -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column flex-md-row p-0">

        <!-- LEFT -->
        <div class="left col-md-6 d-flex align-items-center justify-content-center p-4">
            <img src="{{ asset('images/ilustration.png') }}" alt="gambar" class="img-fluid ilustrasi">
        </div>

        <!-- RIGHT -->
        <div class="right col-md-6 d-flex align-items-center justify-content-center p-4">
            <div class="card-custom text-center">
                <div class="title">APLIKASI MANAJEMEN PERPUSTAKAAN</div>
                <hr>
                <div class="subtitle">Hello! Selamat Datang</div>

                <button class="btn-custom mb-3" onclick="window.location.href='{{ url('/login') }}'">MASUK</button>
                <button class="btn-custom" onclick="window.location.href='{{ url('/register') }}'">DAFTAR</button>
            </div>
        </div>

    </div>

    <!-- BOOTSTRAP JS (WAJIB UNTUK COMPONENT) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>