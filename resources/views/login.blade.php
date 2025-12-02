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

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf

                    <div class="text-left mb-3">
                        <label class="font-bold">Email Pengguna</label>
                        <input 
                            type="email" 
                            name="email"
                            value="{{ old('email') }}"
                            class="input-custom w-full mt-1 @error('email') border-red-500 @enderror"
                            placeholder="Email"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-left mb-3">
                        <label class="font-bold">Kata Sandi</label>
                        <input 
                            type="password" 
                            name="kata_sandi"
                            class="input-custom w-full mt-1 @error('kata_sandi') border-red-500 @enderror"
                            placeholder="Masukkan kata sandi"
                            required
                        >
                        @error('kata_sandi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-custom w-full mt-4">
                        MASUK
                    </button>

                </form>
            </div>

        </div>

    </div>

</body>
</html>