<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Staff' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/string-matching-service.js') }}"></script>
    
    <style>
        .menu-item {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 10px 0;
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            opacity: 0.8;
        }

        .menu-item.active .icon-wrapper {
            background-color: #F7DE68;
            border-radius: 12px;
            padding: 8px;
        }

        .icon-wrapper {
            transition: all 0.2s ease;
            padding: 8px;
            border-radius: 12px;
        }
    </style>
</head>
<body class="min-h-screen text-gray-800" style="background: linear-gradient(180deg,#f7d77a 0%, #f6d99f 30%, #fff7ec 100%);">
<div class="flex">
    <!-- SIDEBAR -->
    <div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6 relative">
        <!-- MENU ATAS -->
        <div class="flex flex-col items-center space-y-8 pt-8 w-full">
            <a href="{{ route('staff.dashboard') }}" class="menu-item" aria-label="Dashboard" data-route="staff.dashboard">
                <div class="icon-wrapper">
                    <x-icon name="home" class="w-7 h-7 text-white" />
                </div>
            </a>
            <a href="{{ route('staff.kelola-buku') }}" class="menu-item" aria-label="Kelola Buku" data-route="staff.kelola-buku">
                <div class="icon-wrapper">
                    <x-icon name="buku" class="w-7 h-7 text-white" />
                </div>
            </a>
            <a href="{{ route('staff.laporan-peminjaman') }}" class="menu-item" aria-label="Laporan Peminjaman" data-route="staff.laporan-peminjaman">
                <div class="icon-wrapper">
                    <x-icon name="grafik" class="w-7 h-7 text-white" />
                </div>
            </a>
            <a href="{{ route('staff.data-anggota') }}" class="menu-item" aria-label="Data Anggota" data-route="staff.data-anggota">
                <div class="icon-wrapper">
                    <x-icon name="anggota" class="w-7 h-7 text-white" />
                </div>
            </a>
            <a href="{{ route('staff.pengaturan') }}" class="menu-item" aria-label="Pengaturan" data-route="staff.pengaturan">
                <div class="icon-wrapper">
                    <x-icon name="setting" class="w-7 h-7 text-white" />
                </div>
            </a>
        </div>

        <!-- LOGOUT PALING BAWAH -->
        <a href="{{ url('/logout') }}" class="menu-item mt-auto mb-4" aria-label="Logout">
            <div class="icon-wrapper">
                <x-icon name="logout" class="w-7 h-7 text-white" />
            </div>
        </a>
    </div>

    <!-- MAIN -->
    <div class="flex-1 py-6 px-8">
        <!-- TOPBAR -->
        <div class="flex justify-end items-center w-full py-4 px-6 space-x-6">
            <div class="flex items-center space-x-2">
                <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(session('nama', 'ST'), 0, 2)) }}
                </div>
                <div class="text-left">
                    <div class="text-black font-medium leading-tight">{{ session('nama', 'Staff') }}</div>
                    <div class="text-xs text-gray-600">Staff</div>
                </div>
            </div>
        </div>

        <div class="w-full border-b-2 border-white mb-6"></div>

        <main class="pb-10">
            {{ $slot }}
        </main>
    </div>
</div>

<script>
    // Set active state pada menu berdasarkan route saat ini
    const currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.menu-item[data-route]');

    // Set menu aktif berdasarkan path
    menuItems.forEach((item) => {
        const route = item.getAttribute('data-route');
        
        // Cek apakah route ini sesuai dengan path saat ini
        let isActive = false;
        if (currentPath === '/staff' && route === 'staff.dashboard') {
            isActive = true;
        } else if (currentPath.includes('/staff/kelola-buku') && route === 'staff.kelola-buku') {
            isActive = true;
        } else if (currentPath.includes('/staff/laporan-peminjaman') && route === 'staff.laporan-peminjaman') {
            isActive = true;
        } else if (currentPath.includes('/staff/data-anggota') && route === 'staff.data-anggota') {
            isActive = true;
        } else if (currentPath.includes('/staff/pengaturan') && route === 'staff.pengaturan') {
            isActive = true;
        }

        if (isActive) {
            item.classList.add('active');
        }
    });
</script>
</body>
</html>

