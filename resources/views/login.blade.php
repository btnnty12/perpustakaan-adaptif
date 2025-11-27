<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Manajemen Perpustakaan</title>

    <!-- BOOTSTRAP ONLINE CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CUSTOM -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="container-fluid d-flex flex-column flex-md-row vh-100 p-0">

        <!-- LEFT -->
        <div class="left col-md-6 d-flex align-items-center justify-content-center p-4">
            <img src="{{ asset('images/ilustration.png') }}" class="img-fluid" alt="gambar">
        </div>

        <!-- RIGHT -->
        <div class="right col-md-6 d-flex align-items-center justify-content-center p-4">

            <div class="card-custom text-center">
                <div class="title">APLIKASI MANAJEMEN PERPUSTAKAAN</div>
                <hr>

                <form>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Nama Pengguna</label>
                        <input type="text" class="form-control input-custom" placeholder="Masukkan nama pengguna">
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Kata Sandi</label>
                        <input type="password" class="form-control input-custom" placeholder="Masukkan kata sandi">
                    </div>

                    <button class="btn-custom mt-3">MASUK</button>

                </form>

            </div>
        </div>

    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>