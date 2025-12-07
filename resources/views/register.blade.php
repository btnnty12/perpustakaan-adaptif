<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Perpustakaan</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body class="min-h-screen flex justify-center items-center bg-gradient-to-br from-yellow-100 to-yellow-300">

    <div class="bg-white shadow-xl rounded-xl w-full max-w-md p-8">

        <h2 class="text-2xl font-bold text-center mb-6">FORM PENDAFTARAN</h2>

        <!-- FLASH MESSAGE -->
        @if (session('success'))
            <div class="bg-green-200 text-green-700 px-4 py-2 rounded-md text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                       placeholder="Masukkan nama lengkap">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                       placeholder="Masukkan email aktif">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Kata Sandi</label>
                <input type="password" name="password" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                       placeholder="Masukkan kata sandi">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">No Telepon</label>
                <input type="text" name="phone" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                       placeholder="Masukkan nomor telepon">
            </div>

            <button class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition">
                DAFTAR
            </button>

            <p class="text-center mt-4">
                Sudah punya akun? 
                <a href="/login" class="text-blue-600 hover:underline">Masuk</a>
            </p>

        </form>

    </div>

</body>
</html>