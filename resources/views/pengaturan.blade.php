<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-[#f6d47f] flex">

<aside class="w-20 bg-[#C34722] text-white flex flex-col items-center py-6 shadow-lg relative">
    <div class="flex flex-col items-center space-y-8 flex-1">
        <button onclick="window.location.href='{{ url('/home') }}';"
            class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fa-solid fa-house"></i>
        </button>

        <button onclick="window.location.href='/search';" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
            <i class="fas fa-magnifying-glass"></i>
        </button>
        
        <button onclick="window.location.href='/pengembalian-buku';"
    class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100"><i class="fa-solid fa-file-lines"></i></button>
</button>

        <button 
    onclick="window.location.href='/pinjaman';"
    class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
    <i class="fa-solid fa-book"></i>
</button>

        <button onclick="window.location.href='/favorit';"
    class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
    <i class="fa-solid fa-heart"></i>
</button>

        <button onclick="window.location.href='/favorit';"
    class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
    <i class="fa-solid fa-heart"></i>
</button>

        <button onclick="window.location.href='/pengaturan';" 
        class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100">
    <i class="fa-solid fa-gear"></i>
</button>
    </div>

    <button onclick="window.location.href='{{ url('/logout') }}'" class="menu-item w-12 h-12 flex items-center justify-center text-2xl opacity-80 hover:opacity-100 mb-4 mt-auto">
        <i class="fas fa-sign-out-alt"></i>
    </button>
</aside>

<div class="flex-1 py-6 px-10">
    <div class="section-wrapper">
        <h1 class="text-4xl font-bold text-[#A63A2D]">Pengaturan Akun</h1>
        <p class="text-gray-700 mt-1">Kelola informasi akun dan data profil Anda.</p>

        <div class="bg-white w-[97%] shadow-xl rounded-xl p-10 mt-10">

            <!-- FLASH MESSAGE -->
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-200 text-red-800 p-3 rounded mb-5">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col items-center text-center mb-10">
                    <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('icons/profile.png') }}" id="profilePreview" class="w-32 h-32 rounded-full shadow mb-4">

                    <label class="mt-2 cursor-pointer bg-[#A63A2D] hover:bg-[#923223] text-white px-4 py-2 rounded">
                        Ubah Foto
                        <input type="file" name="profile_photo" id="profilePhotoInput" class="hidden" accept="image/*">
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-10">
                    <!-- Semua role bisa edit -->
                    <div>
                        <label class="font-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" class="mt-1 w-full p-3 rounded border shadow">
                    </div>

                    <div>
                        <label class="font-semibold">ID User</label>
                        <input type="text" value="{{ Auth::user()->id }}" class="mt-1 w-full p-3 rounded border shadow" disabled>
                    </div>

                    <div>
                        <label class="font-semibold">Kata Sandi</label>
                        <input type="password" name="kata_sandi" placeholder="Isi jika ingin ganti" class="mt-1 w-full p-3 rounded border shadow">
                    </div>

                    <div>
                        <label class="font-semibold">Tanggal Bergabung</label>
                        <input type="text" value="{{ Auth::user()->created_at->format('d F Y') }}" class="mt-1 w-full p-3 rounded border shadow" disabled>
                    </div>

                    <div>
                        <label class="font-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="mt-1 w-full p-3 rounded border shadow">
                    </div>

                    <div>
                        <label class="font-semibold">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="mt-1 w-full p-3 rounded border shadow">
                    </div>

                    <!-- Hanya muncul untuk admin -->
                    @if(Auth::user()->peran === 'admin')
                    <div>
                        <label class="font-semibold">Role User</label>
                        <select name="peran" class="mt-1 w-full p-3 rounded border shadow">
                            <option value="admin" {{ Auth::user()->peran === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="staff" {{ Auth::user()->peran === 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="anggota" {{ Auth::user()->peran === 'anggota' ? 'selected' : '' }}>Anggota</option>
                        </select>
                    </div>
                    @endif
                </div>

                <div class="flex justify-center mt-12">
                    <button type="submit" class="bg-[#A63A2D] hover:bg-[#923223] transition text-white px-10 py-3 rounded-xl font-bold text-lg shadow">
                        Perbarui
                    </button>
                </div>
            </form>

            <p class="text-center text-gray-500 text-sm mt-5">
                Hai {{ Auth::user()->nama }}, pastikan data profilmu selalu diperbarui agar layanan perpustakaan tetap lancar ya!
            </p>
        </div>
    </div>
</div>

<script>
const input = document.getElementById('profilePhotoInput');
const preview = document.getElementById('profilePreview');

input.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>