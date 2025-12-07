<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Favorit - Perpustakaan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-gradient-to-b from-yellow-200 to-yellow-300 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-20 bg-[#C34722] text-white flex flex-col items-center py-6 shadow-lg relative">
    <div class="flex flex-col items-center space-y-8 flex-1">
        <button onclick="window.location.href='/'" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-house"></i>
        </button>
        <button onclick="window.location.href='/search';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button onclick="window.location.href='/favorit';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-heart"></i>
        </button>
        <button onclick="window.location.href='/pengaturan';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-gear"></i>
        </button>
    </div>

    <button onclick="window.location.href='/logout'" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100 mb-4 mt-auto">
        <i class="fa-solid fa-right-from-bracket"></i>
    </button>
</aside>

<!-- MAIN CONTENT -->
<main class="flex-1 p-8">

    <h1 class="text-4xl font-bold mb-6 text-[#A63A2D]">Buku Favoritmu</h1>
    <p class="text-gray-700 mb-8">Lihat buku-buku yang sudah kamu tandai sebagai favorit.</p>

    <!-- GRID FAVORIT -->
    <div class="overflow-x-auto">
        <div class="flex gap-6 pb-4">

            <!-- Buku 1 -->
            <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-lg min-w-[200px]">
                <img src="images/machine Learning.jpeg" class="w-36 h-48 object-cover rounded-xl shadow mb-2">
                <p class="font-semibold text-center">Machine<br>Learning</p>
                <button class="mt-2 text-red-600 font-bold remove-fav"><i class="fa-solid fa-trash"></i></button>
            </div>

            <!-- Buku 2 -->
            <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-lg min-w-[200px]">
                <img src="images/download (1).jpeg" class="w-36 h-48 object-cover rounded-xl shadow mb-2">
                <p class="font-semibold text-center">Artificial<br>Intelligence</p>
                <button class="mt-2 text-red-600 font-bold remove-fav"><i class="fa-solid fa-trash"></i></button>
            </div>

            <!-- Buku 3 -->
            <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-lg min-w-[200px]">
                <img src="images/download (2).jpeg" class="w-36 h-48 object-cover rounded-xl shadow mb-2">
                <p class="font-semibold text-center">Cyber<br>Security</p>
                <button class="mt-2 text-red-600 font-bold remove-fav"><i class="fa-solid fa-trash"></i></button>
            </div>

            <!-- Buku 4 -->
            <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-lg min-w-[200px]">
                <img src="images/Kalkulus.jpeg" class="w-36 h-48 object-cover rounded-xl shadow mb-2">
                <p class="font-semibold text-center">Kalkulus<br>Book</p>
                <button class="mt-2 text-red-600 font-bold remove-fav"><i class="fa-solid fa-trash"></i></button>
            </div>

            <!-- Tambahkan buku favorit lainnya -->
        </div>
    </div>

</main>

<script>
    // Hapus buku favorite dari UI
    document.querySelectorAll(".remove-fav").forEach(btn => {
        btn.addEventListener("click", () => {
            const parent = btn.parentElement;
            parent.remove();
            alert("Buku dihapus dari favorit!");
        });
    });
</script>

</body>
</html>