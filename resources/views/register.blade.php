<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Perpustakaan</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS custom jika diperlukan -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body class="min-h-screen flex justify-center items-center 
             bg-gradient-to-br from-red-100 via-orange-100 to-yellow-100">

    <!-- CARD -->
    <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-2xl w-full max-w-md p-10 relative border border-red-200">

        <!-- TOMBOL BACK PREMIUM -->
        <a href="/"
            class="absolute top-4 left-4 w-10 h-10 flex items-center justify-center
                   bg-gradient-to-br from-red-500 to-red-600
                   border border-red-700
                   text-white rounded-full shadow-lg 
                   hover:brightness-110 hover:shadow-xl
                   transition-all duration-300">

            <!-- Icon panah -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>

        <!-- TITLE -->
        <h2 class="text-3xl font-bold text-center mb-6 
                   bg-gradient-to-r from-red-600 to-red-500 text-transparent bg-clip-text">
            FORM PENDAFTARAN
        </h2>

        <!-- FLASH MESSAGE -->
        @if (session('success'))
            <div class="bg-green-200 text-green-700 px-4 py-2 rounded-md text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM (TIDAK DIUBAH) -->
        <form action="/register" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" 
                    value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 
                           focus:outline-none focus:ring-2 focus:ring-red-400
                           @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" 
                    value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 
                           focus:outline-none focus:ring-2 focus:ring-red-400
                           @error('email') border-red-500 @enderror"
                    placeholder="Masukkan email aktif" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Kata Sandi</label>
                <input type="password" name="password" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 
                           focus:outline-none focus:ring-2 focus:ring-red-400
                           @error('password') border-red-500 @enderror"
                    placeholder="Masukkan kata sandi (minimal 6 karakter)" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">No Telepon</label>
                <input type="text" name="phone"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 
                           focus:outline-none focus:ring-2 focus:ring-red-400"
                    placeholder="Masukkan nomor telepon">
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-gradient-to-br from-red-500 to-red-600 
                           text-white font-semibold py-2 rounded-lg 
                           hover:brightness-110 transition-all duration-300 shadow-md">
                DAFTAR
            </button>

            <p class="text-center mt-4">
                Sudah punya akun? 
                <a href="/login" class="text-red-600 font-semibold hover:underline">Masuk</a>
            </p>

        </form>

    </div>

</body>
</html>