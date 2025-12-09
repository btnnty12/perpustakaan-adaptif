<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6d47f] flex">

<style>
#indicator {
    position: absolute;
    left: 0;
    top: 522px; /* POSISI MENU USER */
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

.section-wrapper { width: 100%; padding-left: 25px; padding-right: 40px; margin-top: 20px; }
</style>

<!-- ============================ SIDEBAR ============================ -->
<div class="w-20 bg-[#a63a2d] min-h-screen flex flex-col items-center py-6">
    <div id="indicator"></div>
    <div class="flex flex-col items-center space-y-20 pt-20">
        <div class="menu-item"><img src="{{ asset('images/icon-home.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-anggota.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-buku.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-grafik.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-kelola-user.png') }}" class="w-7"></div>
        <div class="menu-item"><img src="{{ asset('images/icon-setting.png') }}" class="w-7"></div>
    </div>
    <img src="{{ asset('images/icon-logout.png') }}" class="w-7 mt-auto mb-4">
</div>

<!-- ============================ CONTENT ============================ -->
<div class="flex-1 py-6 px-10">

    <!-- TOPBAR -->
    <div class="flex justify-end items-center w-full py-4 px-10 text-white space-x-6">
        <div class="border-l border-white h-6"></div>
        <img src="{{ asset('images/icon-email.png') }}" class="w-6">
        <img src="{{ asset('images/icon-notification.png') }}" class="w-6">
        <div class="border-l border-white h-6"></div>

        <div class="flex items-center space-x-2">
            <div class="bg-[#717BFF] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">FA</div>
            <span class="text-black font-medium">Fayza Azzahra</span>
            <img src="{{ asset('images/icon-down-arrow.png') }}" class="w-4 ml-1">
        </div>
    </div>

    <div class="w-full border-b-2 border-white mb-6"></div>

    <!-- ============================ MAIN CONTENT ============================ -->
    <div class="section-wrapper">
        <h1 class="text-4xl font-bold">Kelola User !</h1>
        <p class="text-gray-700 mt-1">Atur daftar admin, staff, maupun user mahasiswa.</p>

        <!-- STATISTIK -->
        <div class="flex justify-center gap-7 mt-8">
            <div class="bg-[#A24731] w-56 h-28 rounded-xl text-white shadow-xl flex flex-col justify-center items-center">
                <h2 class="text-4xl font-bold">52</h2>
                <p>Total User</p>
            </div>
            <div class="bg-[#A24731] w-56 h-28 rounded-xl text-white shadow-xl flex flex-col justify-center items-center">
                <h2 class="text-4xl font-bold">5</h2>
                <p>Admin</p>
            </div>
            <div class="bg-[#A24731] w-56 h-28 rounded-xl text-white shadow-xl flex flex-col justify-center items-center">
                <h2 class="text-4xl font-bold">10</h2>
                <p>Staff</p>
            </div>
            <div class="bg-[#A24731] w-56 h-28 rounded-xl text-white shadow-xl flex flex-col justify-center items-center">
                <h2 class="text-4xl font-bold">37</h2>
                <p>User (Mahasiswa)</p>
            </div>
        </div>

        <!-- FORM TAMBAH USER -->
        <div class="bg-white w-[97%] shadow-lg rounded-lg p-6 mt-10">
            <h2 class="text-xl font-bold mb-4 text-[#A63A2D]">Tambah User Baru</h2>

            <div class="grid grid-cols-3 gap-5">
                <input type="text" placeholder="Nama Lengkap" class="p-3 rounded-lg shadow border">
                <input type="text" placeholder="Username" class="p-3 rounded-lg shadow border">
                <select class="p-3 rounded-lg shadow border">
                    <option>Pilih Role</option>
                    <option>Admin</option>
                    <option>Staff</option>
                    <option>User (Mahasiswa)</option>
                </select>
                <input type="text" placeholder="Email" class="p-3 rounded-lg shadow border">
                <input type="password" placeholder="Password" class="p-3 rounded-lg shadow border">
                <button class="bg-[#2476FF] text-white rounded-lg font-bold py-2 px-4">Tambah</button>
            </div>
        </div>

        <!-- FILTER -->
        <div class="flex justify-center gap-4 mt-8">
            <input id="userSearch" type="text" placeholder="Search user..." class="w-80 p-3 rounded-lg shadow">
            <select id="roleFilter" class="p-3 w-48 rounded-lg shadow">
                <option value="">Filter Role</option>
                <option>Admin</option>
                <option>Staff</option>
                <option>User</option>
            </select>
            <button id="userSearchBtn" class="bg-[#2476FF] text-white px-6 py-3 rounded-lg font-bold">Search</button>
        </div>
    </div>

    <!-- TABEL USER -->
    <div class="mt-10 bg-white rounded-lg shadow overflow-hidden w-[97%]">
        <table class="w-full text-left">
            <thead class="bg-[#b54a38] text-white">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Username</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-6 py-3">USR-001</td>
                    <td class="px-6 py-3">Fayza Azzahra</td>
                    <td class="px-6 py-3">fayza12</td>
                    <td class="px-6 py-3">fayza@gmail.com</td>
                    <td class="px-6 py-3 font-semibold text-blue-600">Admin</td>
                    <td class="px-6 py-3 flex gap-4">
                        <img src="{{ asset('icons/edit.png') }}" class="w-5">
                        <img src="{{ asset('icons/delete.png') }}" class="w-5">
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="px-6 py-3">USR-002</td>
                    <td class="px-6 py-3">Nuriyanti</td>
                    <td class="px-6 py-3">Nuriyanti14</td>
                    <td class="px-6 py-3">Nuriyanti@gmail.com</td>
                    <td class="px-6 py-3 font-semibold text-green-600">Staff</td>
                    <td class="px-6 py-3 flex gap-4">
                        <img src="{{ asset('icons/edit.png') }}" class="w-5">
                        <img src="{{ asset('icons/delete.png') }}" class="w-5">
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="px-6 py-3">USR-003</td>
                    <td class="px-6 py-3">Kaysa dzikrya</td>
                    <td class="px-6 py-3">kaysa11</td>
                    <td class="px-6 py-3">kaysa@gmail.com</td>
                    <td class="px-6 py-3 font-semibold text-purple-600">User</td>
                    <td class="px-6 py-3 flex gap-4">
                        <img src="{{ asset('icons/edit.png') }}" class="w-5">
                        <img src="{{ asset('icons/delete.png') }}" class="w-5">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="flex flex-col items-center justify-center space-y-3 mt-6">
        <div class="flex items-center space-x-4">
            <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">‹</button>
            <button class="w-7 h-7 flex items-center justify-center bg-[#A63A2D] text-white rounded-full">1</button>
            <button class="w-7 h-7 flex items-center justify-center bg-gray-300 rounded-full text-gray-800">2</button>
            <button class="w-7 h-7 flex items-center justify-center bg-gray-300 rounded-full text-gray-800">3</button>
            <button class="w-8 h-8 flex items-center justify-center bg-gray-300 rounded-full text-gray-700">›</button>
        </div>
    </div>

</div>

<script>
document.querySelectorAll('.menu-item').forEach((item, index) => {
    item.addEventListener('click', function () {

        document.getElementById('indicator').style.top = (310 + index * 95) + 'px';

        // ROUTING UNTUK ADMIN
        if (index === 0) window.location.href = "/admin";           // dashboard
        if (index === 1) window.location.href = "/data-anggota";     // kelola buku
        if (index === 2) window.location.href = "/kelola-buku";    // data anggota
        if (index === 3) window.location.href = "/laporan-peminjaman"; // laporan
        if (index === 4) window.location.href = "/kelola-user";     // kelola user
        if (index === 5) window.location.href = "/pengaturan";      // setting
    });
});
</script>

<!-- FILTER & SEARCH KELOLA USER -->
<script>
(function(){
  const searchInput = document.getElementById('userSearch');
  const roleSelect  = document.getElementById('roleFilter');
  const btnSearch   = document.getElementById('userSearchBtn');
  const rows        = Array.from(document.querySelectorAll('tbody tr'));

  function filter(){
    const q    = (searchInput?.value || '').toLowerCase();
    const role = (roleSelect?.value || '').toLowerCase();

    rows.forEach(row => {
      const nama    = row.children[1].textContent.toLowerCase();
      const user    = row.children[2].textContent.toLowerCase();
      const email   = row.children[3].textContent.toLowerCase();
      const rText   = row.children[4].textContent.trim().toLowerCase();

      const matchSearch = !q || nama.includes(q) || user.includes(q) || email.includes(q) || rText.includes(q);
      const matchRole   = !role || rText === role; // role dropdown kini memakai "User" agar sama dengan tabel

      row.style.display = (matchSearch && matchRole) ? '' : 'none';
    });
  }

  searchInput?.addEventListener('input', filter);
  roleSelect?.addEventListener('change', filter);
  btnSearch?.addEventListener('click', (e)=>{ e.preventDefault(); filter(); });
})();
</script>
</body>
</html>