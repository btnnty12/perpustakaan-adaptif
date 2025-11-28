<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Perpustakaan</title>

    <!-- BOOTSTRAP ONLINE (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CUSTOM -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body class="bg-custom d-flex justify-content-center align-items-center vh-100">

    <div class="card-custom">

        <h2 class="title text-center">FORM PENDAFTARAN</h2>

        <form>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Masukkan email aktif">
            </div>

            <div class="mb-3">
                <label class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" placeholder="Masukkan kata sandi">
            </div>

            <div class="mb-3">
                <label class="form-label">No Telepon</label>
                <input type="text" class="form-control" placeholder="Masukkan nomor telepon">
            </div>

            <button class="btn btn-success w-100 btn-daftar">DAFTAR</button>

        </form>

    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>