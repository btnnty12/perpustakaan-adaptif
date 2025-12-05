<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f6d47f] flex">

<style>
    #indicator {
        position: absolute;
        left: 0;
        top: 628px; /* POSISI NAV, UNTUK MENU PENGATURAN */
        width: 75px;
        height: 38px;
        background-color: #F7DE68;
        border-radius: 0 20px 20px 0;
        box-shadow: 0 6px 10px rgba(0,0,0,0.35);
        transition: 0.3s ease-in-out;
        z-index: 0;
    }
    .menu-item { position: relative; z-index: 5; }
    .menu-item img { width: 26px; height: 26px; }

    .section-wrapper { 
        width: 100%; 
        padding-left: 25px; 
        padding-right: 40px; 
        margin-top: 20px; 
    }
</style>

<!-- ============================ SIDEBAR ============================ -->
<div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6">
    <div id="indicator"></div>

    <div class="flex flex-col items-center space-y-20 pt-20">
        <div class="menu-item"><img src="{{ asset('icons/home.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('icons/book.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('icons/list.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('icons/user.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('icons/user.png') }}"></div>
        <div class="menu-item"><img src="{{ asset('icons/setting.png') }}"></div>
    </div>

    <img src="{{ asset('icons/logout.png') }}" class="w-7 mt-auto mb-4">
</div>

<!-- ============================ CONTENT ============================ -->
<div class="flex-1 py-6 px-10">

    <!-- TOPBAR (PERSIS KELOLA USER) -->
    <div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">

        <div class="border-l border-white h-6"></div>
        <img src="{{ asset('icons/mail.png') }}" class="w-6">
        <img src="{{ asset('icons/bell.png') }}" class="w-6">
        <div class="border-l border-white h-6"></div>

        <div class="flex items-center space-x-2">
            <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
                FA
            </div>
            <span class="text-black font-medium">Fayza Azzahra</span>
            <img src="{{ asset('icons/arrow-down.png') }}" class="w-4 ml-1">
        </div>
    </div>

    <div class="w-full border-b-2 border-white mb-6"></div>

    <!-- ============================ HALAMAN PENGATURAN ============================ -->
    <div class="section-wrapper">

        <h1 class="text-4xl font-bold text-[#A63A2D]">Pengaturan Akun</h1>
        <p class="text-gray-700 mt-1">Kelola informasi akun dan data profil Anda.</p>

        <div class="bg-white w-[97%] shadow-xl rounded-xl p-10 mt-10">

            <!-- FOTO PROFIL & INFO -->
            <div class="flex flex-col items-center text-center mb-10">
                <img src="{{ asset('icons/profile.png') }}" class="w-32 h-32 rounded-full shadow mb-4">

                <h2 class="text-2xl font-bold">Fayza Azzahra</h2>
                <p class="text-gray-500 -mt-1">Indonesia, Jakarta</p>
            </div>

            <!-- FORM GRID -->
            <div class="grid grid-cols-2 gap-10">

                <!-- Nama -->
                <div>
                    <label class="font-semibold">Nama Lengkap</label>
                    <input type="text" value="Fayza Azzahra" class="mt-1 w-full p-3 rounded border shadow">
                </div>

                <!-- ID -->
                <div>
                    <label class="font-semibold">ID Admin</label>
                    <input type="text" value="20250112" class="mt-1 w-full p-3 rounded border shadow">
                </div>

                <!-- Password -->
                <div>
                    <label class="font-semibold">Kata Sandi</label>
                    <input type="password" value="********" class="mt-1 w-full p-3 rounded border shadow">
                </div>

                <!-- Tanggal Bergabung -->
                <div>
                    <label class="font-semibold">Tanggal Bergabung</label>
                    <input type="text" value="17 April 2025" class="mt-1 w-full p-3 rounded border shadow">
                </div>

                <!-- Email -->
                <div>
                    <label class="font-semibold">Email</label>
                    <input type="text" value="fayzaazzf@gmail.com" class="mt-1 w-full p-3 rounded border shadow">
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="font-semibold">No. Telepon</label>
                    <input type="text" value="0812328937" class="mt-1 w-full p-3 rounded border shadow">
                </div>

            </div>

            <!-- BUTTON PERBARUI -->
            <div class="flex justify-center mt-12">
                <button class="bg-[#A63A2D] hover:bg-[#923223] transition text-white px-10 py-3 rounded-xl font-bold text-lg shadow">
                    Perbarui
                </button>
            </div>

            <p class="text-center text-gray-500 text-sm mt-5">
                Hai Fayza, pastikan data profilmu selalu diperbarui agar layanan perpustakaan tetap lancar ya!
            </p>

        </div>

    </div>

</div>

</body>
</html>
