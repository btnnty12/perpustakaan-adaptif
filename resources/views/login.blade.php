<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Manajemen Perpustakaan</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- STYLE CUSTOM (warna + desain asli) -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="m-0 p-0">

    <div class="w-full min-h-screen flex flex-col md:flex-row">

        <!-- LEFT -->
        <div class="left md:w-1/2 flex items-center justify-center p-6">
            <img src="{{ asset('images/ilustration.png') }}" class="max-w-full" alt="gambar">
        </div>

        <!-- RIGHT -->
        <div class="right md:w-1/2 flex items-center justify-center p-6">

            <div class="card-custom text-center w-full max-w-md">

                <div class="title">APLIKASI MANAJEMEN PERPUSTAKAAN</div>
                <hr>

                <form method="POST" action="/login">
                    @csrf

                    <div class="text-left mb-3">
                        <label class="font-bold">Nama Pengguna</label>
                        <input 
                            type="text" 
                            name="username"
                            class="input-custom w-full mt-1"
                            placeholder="Masukkan nama pengguna"
                            required
                        >
                    </div>

                    <div class="text-left mb-3">
                        <label class="font-bold">Kata Sandi</label>
                        <input 
                            type="password" 
                            name="password"
                            class="input-custom w-full mt-1"
                            placeholder="Masukkan kata sandi"
                            required
                        >
                    </div>

                    <button class="btn-custom w-full mt-4">
                        MASUK
                    </button>

                </form>
            </div>

        </div>

    </div>

</body>
</html>